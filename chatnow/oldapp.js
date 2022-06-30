const fs = require("fs");
const https = require("https");
const dialogflow = require('dialogflow');
const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
var nodemailer = require('nodemailer');
const { WebhookClient } = require('dialogflow-fulfillment');
const { Card, Suggestion } = require('dialogflow-fulfillment');
const SuggestionsResponse = require('dialogflow-fulfillment/src/rich-responses/suggestions-response');
const PayloadResponse = require('dialogflow-fulfillment/src/rich-responses/payload-response');

const PORT = '8080';
const app = express();

const options = {
  key: fs.readFileSync('cert/privkey.pem'),
  cert: fs.readFileSync('cert/fullchain.pem')
};


app.use(bodyParser.urlencoded({
  extended:false
}));

app.use(function (req, res, next) {

  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');
  res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type');
  res.setHeader('Access-Control-Allow-Credentials', true);

  // Pass to next layer of middleware
  next();
});

app.get('/', function (req, res) {

    /* let transporter = nodemailer.createTransport({
      service: 'gmail',
      auth: {
        type: 'OAuth2',
        user: 'welcome@annextrades.com',
        pass: 'Annexis@123',
        clientId: '534791403033-bigs3nnmsdm9sp4vlg9bb58tnku5ed0m.apps.googleusercontent.com',
        clientSecret: '7EZU-R0KpEkchqwxs0bmsb1m',
        refreshToken: '1//04sZmxk-R8DA2CgYIARAAGAQSNwF-L9Iro8_UlOZP5S3Nb9mgiJx5UzAWXCpYytpHRjQVcYXfgF0uM8OhmwcFs3tfsV5eDIwbqfs'
      }
    });
    let mailOptions = {
      from: 'welcome@annextrades.com',
      to: 'mantu456sharma@gmail.com',
      subject: 'Nodemailer Project',
      text: 'Hi from your nodemailer project'
    };
    transporter.sendMail(mailOptions, function(err, data) {
      if (err) {
        console.log("Error " + err);
      } else {
        console.log("Email sent successfully");
      }
    }); */
  
  });
app.post('/webhook', express.json(), function (req, res,) {
      
  const { dialogflow } = require('actions-on-google'); //npm actions-on-google 2.1.1 
  const agent = new WebhookClient({ request :req, response : res});
  //console.log('Dialogflow Request headers: ' + JSON.stringify(req.headers));
  //console.log('Dialogflow Request body: ' + JSON.stringify(req.body));
         
  function connectToDatabase(){
      const connection = mysql.createConnection({
          host: "localhost",
          user: "root",
          password: "65eca298d9927ee20303e0349d2c2602e01a4a1e8b411d2f",
          database: "annexis_directory"
      });
      return new Promise((resolve,reject) => {
         connection.connect(); 
         resolve(connection);
      });
    }

    async function asktype(agent){
      console.log('MSProduct');
      var type = agent.parameters.product;
      //console.log(type)
      if (type == 'Products' || type == 'Product' || type == 'products' || type == 'product') {
        agent.add('What product you want to sell in USA?')
      }
      else{
        agent.add('What service do you want to offer in the USA?')
      }
    }
    function delay(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
    

    async function name(agent){
      
      var validation = /^[a-zA-Z ]+$/;  

      var Name = agent.parameters.name;
      console.log(Name);
      /* var n = name;
      
      Name = n.name; */
      console.log(Name);

      var str = Name;

      var wordCount = str.match(/(\w+)/g).length;

      var log = agent.contexts;
      //console.log(JSON.stringify(log));
      var i = log.map(
        name => {
          if(name.name=='yeahsure'){
            return name.lifespan
            
          }
        }
        )

      //console.log(i[0]);

      if (i[0] >= 2) {
        if (wordCount < 2 && validation.test(Name)) {
          
          if(i[0] == 2){
            const siqpayload = {"platform": "ZOHOSALESIQ","action": "forward","replies": ["It seems that you have something on your mind. Please give me a moment to get your answer."]};
            //new PayloadResponse(PLATFORMS.PLATFORMS.UNSPECIFIED, siqpayload);
            agent.add(new PayloadResponse('PLATFORM_UNSPECIFIED', siqpayload));
          }else {
            console.log('Name Invalid');
            agent.add("In order for us to complete your invitation, we need your first and last name.");
            agent.add("Please reenter your first and last name:");
          }
        }
        else{
          agent.context.delete('yeahsure');
          console.log('Name Works');
          agent.add('Please provide your company name:');
          agent.context.set({
            name: 'awaiting_name',
            lifespan: 4,
            parameters:{name: Name}
          });
        }
      } 
      else {
        const siqpayload = {"platform": "ZOHOSALESIQ","action": "forward","replies": ["It seems that you have something on your mind. Please give me a moment to get your answer."]};
        //new PayloadResponse(PLATFORMS.PLATFORMS.UNSPECIFIED, siqpayload);
        agent.add(new PayloadResponse('PLATFORM_UNSPECIFIED', siqpayload));
      }
    }

    async function companyname(agent){
      //var validation = /^(?!\s)(?!.*\s$)(?=.*[a-zA-Z0-9])[a-zA-Z0-9 '~?!]{3,}$/;
      //console.log('company name check');
      var companyname = agent.parameters.companyname;
      //console.log(companyname);
    
     /*  var log = agent.contexts;
      //console.log(JSON.stringify(log));
      var i = log.map(
        name => {
          if(name.name=='awaiting_name'){
            return name.lifespan
            
          }
        }
        )

       // console.log(i[0]);

      if (i[0] >= 2) {
      
        if (validation.test(companyname)) { */
          console.log('Company Name Work');
          agent.add('Please provide your email:');
          agent.context.set('awaiting_name', 4);
          agent.context.set('awaiting_companyname', 4, {companyname: companyname});
        /* } else {

          if(i[0] == 2){
            const siqpayload = {"platform": "ZOHOSALESIQ","action": "forward","replies": ["It seems that you have something on your mind. Please give me a moment to get your answer."]};
            //new PayloadResponse(PLATFORMS.PLATFORMS.UNSPECIFIED, siqpayload);
            agent.add(new PayloadResponse('PLATFORM_UNSPECIFIED', siqpayload));
          }else {
            console.log('Company Name Invalid');
            agent.add('We want to confirm that we have your full company name.');
          }

        }

      } else {
        agent.context.delete('awaiting_name');
        const siqpayload = {"platform": "ZOHOSALESIQ","action": "forward","replies": ["It seems that you have something on your mind. Please give me a moment to get your answer."]};
        //new PayloadResponse(PLATFORMS.PLATFORMS.UNSPECIFIED, siqpayload);
        agent.add(new PayloadResponse('PLATFORM_UNSPECIFIED', siqpayload));
      } */

    }


    async function email(agent){
      console.log('email check');
      var validation = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      var email = agent.parameters.email;
     // console.log(email);

      var log = agent.contexts;
      //console.log(JSON.stringify(log));
      var i = log.map(
        name => {
          if(name.name=='awaiting_name'){
            return name.lifespan
            
          }
        }
        )

        //console.log(i[0]);

      if (i[0] >= 2) {

        if (validation.test(email)) {
          
          console.log('Email Work');

          agent.add('Please provide your phone number:');
          agent.context.set('awaiting_name', 4);
          agent.context.set('awaiting_companyname', 4);
          agent.context.set('awaiting_email', 4, {email: email});

        } else {
          if(i[0] == 2){
            const siqpayload = {"platform": "ZOHOSALESIQ","action": "forward","replies": ["It seems that you have something on your mind. Please give me a moment to get your answer."]};
            //new PayloadResponse(PLATFORMS.PLATFORMS.UNSPECIFIED, siqpayload);
            agent.add(new PayloadResponse('PLATFORM_UNSPECIFIED', siqpayload));
          }else {
            console.log('Email Name Invalid');
            agent.add('The system is not accepting the Email ID you provided, something is not adding up.');
            agent.add('Please verify:');
          }
          
        }
      } else {
        agent.context.delete('awaiting_name');
        agent.context.delete('awaiting_companyname');
        const siqpayload = {"platform": "ZOHOSALESIQ","action": "forward","replies": ["It seems that you have something on your mind. Please give me a moment to get your answer."]};
        //new PayloadResponse(PLATFORMS.PLATFORMS.UNSPECIFIED, siqpayload);
        agent.add(new PayloadResponse('PLATFORM_UNSPECIFIED', siqpayload));
      }
    }

    async function phonenumber(agent){
      var phoneno = /^(\+{0,})(\d{0,})([(]{1}\d{1,3}[)]{0,}){0,}(\s?\d+|\+\d{2,3}\s{1}\d+|\d+){1}[\s|-]?\d+([\s|-]?\d+){1,2}(\s){0,}$/;
        var phone = agent.parameters.phonenumber;

        if (phoneno.test(phone)) {
          agent.add('Is this your whatsapp number?');
          let suggestion = new Suggestion('Is this your whatsapp number?');
          suggestion.setReply('Yes');
          agent.add(suggestion);
          agent.add(new SuggestionsResponse(`No`));
          agent.context.set('awaiting_name', 4);
          agent.context.set('awaiting_companyname', 4);
          agent.context.set('awaiting_email', 4);
          agent.context.set('awaiting_phonenumber', 4, {phonenumber: phone});
        }
        else{
          agent.add('Please ensure that you entered your 10 digit telephone number.');
          

        }
    }
    

    async function confirmnumber(agent){
      console.log('ConfirmNumber Working');

        try{
          return new Promise(async function (resolve, reject) {
              //console.log(agent);
              var phone = agent.parameters.phonenumber;
              var name = agent.parameters.name;
              var email = agent.parameters['email']; 
              var company = agent.parameters['companyname'];

            /* var n = Name;
            var name = `${n.name}` */
            console.log(name);
            /* console.log(company);
            console.log(phone);
            console.log(email); */

            
            var fullName = name.split(' '),
            firstname = fullName[0],
            lastname = fullName[fullName.length - 1];


            var type = 'Seller';

            console.log(`${firstname}, ${email}, ${company}, ${type}, ${phone}`);

            const connection = await connectToDatabase();
              console.info(name);
              var sql = "INSERT INTO `tmp_register` (firstname, lastname, email, phonenumber, company_name, user_type) VALUES (?)";
              var values = [firstname, lastname, email, phone, company, 'seller'];
              connection.query(sql, [values], function (error, rows) {
                console.log(error);
                resolve();
                return;
              });
              function queryDatabase(connection){
                return new Promise((resolve, reject) => {
                  connection.query('SELECT * FROM tmp_register WHERE email = ? ORDER BY id DESC LIMIT 1', [email], (error, results, fields) => {
                    resolve(results);
                  });
                });
              }
              return connectToDatabase().then(connection => {
                
                return queryDatabase(connection).then(result => {
                  console.log(result);
                  result.map(user => {
                
                //agent.add(`Thank you.`);
                /* agent.add(`Please login to email account provided to complete your verification to get started.`);
                //setTimeout(() => {
                  agent.add('Do you have any other questions?');
                    let suggestion = new Suggestion('you want assistances?');
                    suggestion.setReply('Yes');
                    agent.add(suggestion);
                    agent.add(new SuggestionsResponse(`No`));
                //}, 5000); */
                const siqpayload = {"platform": "ZOHOSALESIQ","action": "reply","replies": [
                  {
                  "type": "links",
                  "text": "NEXT",
                  "links": [
                    {
                      "url": "https://annextrades.com/webhook/action.php?id="+user.registration_id,
                      "text": "CREATE PASSWORD",
                      "icon": "http://annextrades.com/assets/images/annexis-emblem.png"
                    }
                  ]
                  }
                ]};
                //new PayloadResponse(PLATFORMS.PLATFORMS.UNSPECIFIED, siqpayload);
                agent.add(new PayloadResponse('PLATFORM_UNSPECIFIED', siqpayload));
                agent.context.set('74phonenumber-followup', 1);
                agent.context.delete('awaiting_name');
                agent.context.delete('awaiting_email');
                agent.context.delete('awaiting_companyname');
                agent.context.delete('awaiting_phonenumber');
                    
                console.info(`Your Registration ID ` + user.registration_id);
                //console.log(rows.affectedRows);
                
                let transporter = nodemailer.createTransport({
                  service: 'gmail',
                  auth: {
                    type: 'OAuth2',
                    user: 'welcome@annextrades.com',
                    pass: 'Annexis@123',
                    clientId: '534791403033-bigs3nnmsdm9sp4vlg9bb58tnku5ed0m.apps.googleusercontent.com',
                    clientSecret: '7EZU-R0KpEkchqwxs0bmsb1m',
                    refreshToken: '1//04sZmxk-R8DA2CgYIARAAGAQSNwF-L9Iro8_UlOZP5S3Nb9mgiJx5UzAWXCpYytpHRjQVcYXfgF0uM8OhmwcFs3tfsV5eDIwbqfs'
                  }
                });
               /*  let mailOptions = {
                  from: 'welcome@annextrades.com',
                  to: email,
                  subject: user.firstname + ' Thanks for joining us on AnnexTrades.',
                  html:  `<div class="row">
                  <div class="col-3 m-100">&nbsp;</div>
                    <div class="col-6" style="padding: 30px 15px;">
                      <center style="width: 100%; background-color: #fff; border: 2px solid #ff7900;">
                        <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;  mso-hide: all; font-family: sans-serif;">
                        </div>
                        <div style="max-width: 600px; margin: 0 auto;" class="email-container">
                          <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="align-items: center !important;">
                            <tr>
                              <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                  <tr>
                                    <td valign="middle" class="hero bg_white" style="padding: 3em 0 2em 0;">
                                      <img src="https://annextrades.com/assets/images/logo.png" alt="" style="width: 80%; max-width: 600px; height: auto; margin: auto; display: block;">
                                    </td>
                                  </tr>  
                                  <tr>
                                    <td class="logo" style="text-align: center;">
                                      <h1><a href="#">e-Verify</a></h1>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                            <tr>
                              <td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
                                <div class="text center" style="padding: 0 2.5em; text-align: center;">
                                  <h2>Please verify your email</h2>
                                  <a href="https://annextrades.com/webhook/action.php?id=` + user.registration_id + `" target="_blank" class="btn btn-primary">
                                    <button style="color:#fff; background: #ff7900; border: 0px; padding: 8px 16px;">Verify Email Address</button>
                                  </a></br>
                                  <h3>Your Bridge to Expansion & Increased Market Share.</h3>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </center>
                    </div>
                  <div class="col-3 m-100">&nbsp;</div>
                  </div>`
                }; 
                transporter.sendMail(mailOptions, function(err, data) {
                  if (err) {
                    console.log("Error " + err);
                  } else {
                    console.log("Email sent successfully");
                  }
                });*/
              
              });
            });
          });
        });
        }
        catch(error){
          console.log(error);
        }
    }

    async function ask_whatsapp_no(agent){

      console.log('ask_whatsapp');

      var log = agent.contexts;
      console.log(JSON.stringify(log));
      var i = log.map(
        name => {
          if(name.name=='awaiting_email'){
            return name.lifespan
          }
        }
        )

        console.log(i[0]);

      if (i[0] >= 2) {

        var phoneno = /^(\+{0,})(\d{0,})([(]{1}\d{1,3}[)]{0,}){0,}(\s?\d+|\+\d{2,3}\s{1}\d+|\d+){1}[\s|-]?\d+([\s|-]?\d+){1,2}(\s){0,}$/;
        var phone = agent.parameters.phonenumber;

        if (phoneno.test(phone)) {
          try{
            return new Promise(async function (resolve, reject) {
              
              var name = agent.parameters['name'];
              var email = agent.parameters['email']; 
              var company = agent.parameters['companyname'];

            //var n = Name;
            /* var name = `${n.name}`
            console.log(name); */
            console.log(company);
            console.log(phone);
            console.log(email);

            var fullName = name.split(' '),
            firstname = fullName[0],
            lastname = fullName[fullName.length - 1];
            var type = 'Seller';

            console.log(`${firstname}, ${email}, ${company}, ${type}, ${phone}`);

            const connection = await connectToDatabase();
              console.info(`${name}`);
              var sql = "INSERT INTO `tmp_register` (firstname, lastname, email, phonenumber, company_name, user_type) VALUES (?)";
              var values = [firstname, lastname, email, phone, company, 'seller'];
              connection.query(sql, [values], function (error, rows) {
                console.log(error);
                resolve();
              });
              return connectToDatabase().then(connection => {
                
                function queryDatabase(connection){
                  return new Promise((resolve, reject) => {
                    connection.query('SELECT * FROM tmp_register WHERE email = ? ORDER BY id DESC LIMIT 1', [email], (error, results, fields) => {
                      resolve(results);
                    });
                  });
                }
                return queryDatabase(connection).then(result => {
                  console.log(result);
                  result.map(user => {
                
                //agent.add(`Thank you.`);
                //agent.add(`Please login to email account provided to complete your verification to get started.`);
                const siqpayload = {"platform": "ZOHOSALESIQ","action": "reply","replies": [
                  {
                  "type": "links",
                  "text": "To see current U.S. Government Contract opportunities",
                  "links": [
                    {
                      "url": "https://annextrades.com/dealsbulletin",
                      "text": "DEALS BULLETIN",
                      "icon": "http://annextrades.com/assets/images/annexis-emblem.png"
                    },
                  ]
                  }
                ]};
                //new PayloadResponse(PLATFORMS.PLATFORMS.UNSPECIFIED, siqpayload);
                agent.add(new PayloadResponse('PLATFORM_UNSPECIFIED', siqpayload));
                /* //setTimeout(() => {
                  agent.add('Do you have any other questions?');
                    let suggestion = new Suggestion('you want assistances?');
                    suggestion.setReply('Yes');
                    agent.add(suggestion);
                    agent.add(new SuggestionsResponse(`No`));
                //}, 5000); */
                agent.context.set('74phonenumber-followup', 1);
                agent.context.delete('awaiting_name');
                agent.context.delete('awaiting_email');
                agent.context.delete('awaiting_companyname');
                agent.context.delete('awaiting_phonenumber');
                agent.context.delete('74phonenumber-followup');
                agent.context.set('awating_whatsapp', 2);
                console.info(`Your Registration ID ` + user.registration_id);

                let transporter = nodemailer.createTransport({
                  service: 'gmail',
                  auth: {
                    type: 'OAuth2',
                    user: 'welcome@annextrades.com', 
                    pass: 'Annexis@123',
                    clientId: '534791403033-bigs3nnmsdm9sp4vlg9bb58tnku5ed0m.apps.googleusercontent.com',
                    clientSecret: '7EZU-R0KpEkchqwxs0bmsb1m',
                    refreshToken: '1//04sZmxk-R8DA2CgYIARAAGAQSNwF-L9Iro8_UlOZP5S3Nb9mgiJx5UzAWXCpYytpHRjQVcYXfgF0uM8OhmwcFs3tfsV5eDIwbqfs'
                  }
                });
                /* let mailOptions = {
                  from: 'welcome@annextrades.com',
                  to: email,
                  subject: user.firstname + ' Thanks for joining us on AnnexTrades.',
                  html:  `<div class="row">
                  <div class="col-3 m-100">&nbsp;</div>
                    <div class="col-6" style="padding: 30px 15px;">
                      <center style="width: 100%; background-color: #fff; border: 2px solid #ff7900;">
                        <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;  mso-hide: all; font-family: sans-serif;">
                        </div>
                        <div style="max-width: 600px; margin: 0 auto;" class="email-container">
                          <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="align-items: center !important;">
                            <tr>
                              <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                  <tr>
                                    <td valign="middle" class="hero bg_white" style="padding: 3em 0 2em 0;">
                                      <img src="https://annextrades.com/assets/images/logo.png" alt="" style="width: 80%; max-width: 600px; height: auto; margin: auto; display: block;">
                                    </td>
                                  </tr>  
                                  <tr>
                                    <td class="logo" style="text-align: center;">
                                      <h1><a href="#">e-Verify</a></h1>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                            <tr>
                              <td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
                                <div class="text center" style="padding: 0 2.5em; text-align: center;">
                                  <h2>Please verify your email</h2>
                                  <a href="https://annextrades.com/webhook/action.php?id=` + user.registration_id + `" target="_blank" class="btn btn-primary">
                                    <button style="color:#fff; background: #ff7900; border: 0px; padding: 8px 16px;">Verify Email Address</button>
                                  </a></br>
                                  <h3>Your Bridge to Expansion & Increased Market Share.</h3>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </center>
                    </div>
                  <div class="col-3 m-100">&nbsp;</div>
                  </div>`
                };
                transporter.sendMail(mailOptions, function(err, data) {
                  if (err) {
                    console.log("Error " + err);
                  } else {
                    console.log("Email sent successfully");
                  }
                }); */
                
                //console.log(rows.affectedRows);
                
                /* const accountSid = 'AC49042d3a1fb260ea8e08d7d5d7ab9368'; 
                const authToken = '54e3a0bbea9ed9d313aa255557eaa024'; 
                const client = require('twilio')(accountSid, authToken); 
                
                client.messages 
                .create({ 
                  body: `Thanks `+firstname+` for registration in ANNEXTrades. click on the below link to verify your account and continue https://annextrades.com/webhook/action.php?id=`+user.registration_id,
                 from: 'whatsapp:+13474108856',      
                  to: 'whatsapp:+91'+phone
                }) 
                .then(message => console.log(message.sid)) 
                .done(); */

              }); 
            });
          });
        });
        }
        catch(error){
          console.log(error);
        }
        }else{
          if(i[0] == 2){
            const siqpayload = {"platform": "ZOHOSALESIQ","action": "forward","replies": ["It seems that you have something on your mind. Please give me a moment to get your answer."]};
            //new PayloadResponse(PLATFORMS.PLATFORMS.UNSPECIFIED, siqpayload);
            agent.add(new PayloadResponse('PLATFORM_UNSPECIFIED', siqpayload));
          }else {
            agent.add('Please ensure that you entered your 10 digit Whatsapp number.');
          }
          
        }

      } else {

        agent.context.delete('awaiting_name');
        agent.context.delete('awaiting_email');
        agent.context.delete('awaiting_companyname');

        const siqpayload = {"platform": "ZOHOSALESIQ","action": "forward","replies": ["It seems that you have something on your mind. Please give me a moment to get your answer."]};
        //new PayloadResponse(PLATFORMS.PLATFORMS.UNSPECIFIED, siqpayload);
        agent.add(new PayloadResponse('PLATFORM_UNSPECIFIED', siqpayload));
      }
    }
  // Run the proper function handler based on the matched Dialogflow intent name
  let intentMap = new Map();

  intentMap.set('1Ask type', asktype);
  intentMap.set('71Name', name);
  intentMap.set('72companyname', companyname);
  intentMap.set('73email', email);
  intentMap.set('74phonenumber', phonenumber);
  intentMap.set('74phonenumber - yes', confirmnumber);
  intentMap.set('ask_whatsapp_no', ask_whatsapp_no);
  //intentMap.set('We are experiencing - yes', experiencing);
  agent.handleRequest(intentMap);

});


https.createServer(options, app).listen(PORT, '0.0.0.0', ()=> { console.log(`Server is up and running at`+PORT);

}
);