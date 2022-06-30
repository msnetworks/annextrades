const fs = require("fs");
const https = require("https");
const dialogflow = require('dialogflow');
const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
var nodemailer = require('nodemailer');
const { WebhookClient } = require('dialogflow-fulfillment');


const PORT = '8080';
const app = express();

const options = {
  key: fs.readFileSync('cert/privkey.pem'),
  cert: fs.readFileSync('cert/cert.pem')
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
  var hostname = req.hostname
  if (hostname.includes("domain1")) {
      res.send('hello from domain1');
  } 
  const accountSid = 'AC49042d3a1fb260ea8e08d7d5d7ab9368'; 
    const authToken = '54e3a0bbea9ed9d313aa255557eaa024'; 
    const client = require('twilio')(accountSid, authToken); 
    
    client.messages 
      .create({ 
        from: 'whatsapp:+13474108856',       
        body: `hello ms`, 
        to: 'whatsapp:+918492800628' 
        }) 
      .then(message => console.log(message.sid)) 
      .done();
})

app.post('/webhook', express.json(), function (req, res,) {
      
  const { dialogflow } = require('actions-on-google'); //npm actions-on-google 2.1.1 
  const agent = new WebhookClient({ request :req, response : res});
  //console.log('Dialogflow Request headers: ' + JSON.stringify(req.headers));
  //console.log('Dialogflow Request body: ' + JSON.stringify(req.body));
         
  function connectToDatabase(){
      const connection = mysql.createConnection({
          host: "localhost",
          user: "root",
          password: "Annexis@123",
          database: "annexis_directory"
      });
      return new Promise((resolve,reject) => {
         connection.connect(); 
         resolve(connection);
      });
    }

    

    async function name(agent){
      console.log('ms work');
      var validation = /^[a-zA-Z ]+$/;  
      var name = agent.parameters.name;
      var n = name;
      Name = n.name;
      var str = Name;
      var wordCount = str.match(/(\w+)/g).length;
      //alert(wordCount); //6
      console.log('name check');
      console.log(wordCount);
      
      
        if (wordCount < 2 && validation.test(Name)) {
          console.log('Name Invalid');
          agent.context.set('yeahsure', 1);
          agent.add("The system does not ensure you have first and last names – please provide validation to confirm both first and last name.  :");
        }
        else {
          console.log('Name Works');
          agent.add('Please provide your company name:');
          //agent.context.set('awaiting_name', 8, {name: Name});
          agent.context.set({
            name: 'awaiting_name',
            lifespan: 7,
            parameters:{name: name}
          });
        }
    }

    async function companyname(agent){
      var validation = /^(?!\s)(?!.*\s$)(?=.*[a-zA-Z0-9])[a-zA-Z0-9 '~?!]{6,}$/;
      console.log('company name check');
      var companyname = agent.parameters.companyname;
      console.log(companyname);

      if (validation.test(companyname)) {
        console.log('Company Name Work');
        agent.add('Please provide your email:');
        agent.context.set('awaiting_companyname', 6, {companyname: companyname});
      } else {
        console.log('Company Name Invalid');
        agent.add('The system does not ensure your company names – please provide validation to confirm your company name.  :');
        agent.context.set('awaiting_name', 5);
      }
    }
    async function email(agent){
      console.log('email check');
      var validation = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      var email = agent.parameters.email;
      console.log(email);

      if (validation.test(email)) {
        console.log('Email Work');
        agent.add('Please provide your phone number:');
        agent.context.set('awaiting_email', 4, {email: email});
      } else {
        console.log('Email Name Invalid');
        agent.context.set('awaiting_companyname', 2);
        agent.add('There seems to be something wrong with the email ID you provided, please verify and reenter your email.');
      }
    }


    async function phonenumber(agent){
      console.log('Work phonenumber');
      var phoneno = /^\d{10}$/;
      var phone = agent.parameters.phonenumber;
         

    if (phoneno.test(phone)) {
      /* try{ */
        return new Promise(async function (resolve, reject) {
          
          var test =  agent.contexts;
          console.log(test);
          var email = agent.context.get('awaiting_email').parameters['email'];
          var Name = agent.context.get('awaiting_name').parameters['name'];
          var company = agent.context.get('awaiting_companyname').parameters['companyname'];

        var n = Name;
        var name = `${n.name}`
        console.log(name);
        console.log(company);
        console.log(phone);
        console.log(email);
        

        const regex = /\w+\s\w+(?=\s)|\w+/g;
        const name1 = name;
        const [firstName1, lastName1] = name1.trim().match(regex);
        var firstname = `${firstName1}`;
        var lastname = `${lastName1}`;
        
        var type = 'Seller';

        console.log(`${firstname}, ${email}, ${company}, ${type}, ${phone}`);

        const connection = await connectToDatabase();
          console.info(`${name}`);
          var sql = "INSERT INTO `tmp_register` (firstname, lastname, email, phonenumber, company_name, user_type) VALUES (?)";
          var values = [firstname, lastname, email, phone, company, 'seller'];
          connection.query(sql, [values], function (error, rows) {


            resolve();
            return;
          });
          function queryDatabase(connection_1) {
            return new Promise((resolve_1, reject_1) => {
              connection_1.query('SELECT * FROM tmp_register WHERE email = ? ORDER BY id DESC LIMIT 1', [email], (error_1, results, fields) => {
                resolve_1(results);
              });
            });
          }
          const connection_2 = await connectToDatabase();
          const result_2 = await queryDatabase(connection_2);
          //console.log(result);
          result_2.map(user => {
            agent.add(`Thank you.`);
            agent.add(`Please login to email account provided to complete your verification to get started.`);
            agent.context.delete('awaiting_name');
            agent.context.delete('awaiting_email');
            agent.context.delete('awaiting_companyname');

            console.info(`Your Registration ID ` + user.registration_id);
            //console.log(rows.affectedRows);
            var transporter = nodemailer.createTransport({
              service: 'gmail',
              auth: {
                user: 'annexis.data@gmail.com',
                pass: 'Annexis@786'
              }
            });
            var mailOptions = 
            {
              from: 'welcome@annextrades.com',
              to: email,
              bcc: 'annexis.data@gmail.com',
              subject: user.firstname + ' Thanks for joining us on AnnexTrades.',
              html: 
              `<div class="row">
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

            /* const accountSid = 'AC49042d3a1fb260ea8e08d7d5d7ab9368';
            const authToken = '54e3a0bbea9ed9d313aa255557eaa024';
            const client = require('twilio')(accountSid, authToken);
            
            client.messages
              .create({
                  body: `Thanks `+firstname+` for registration in ANNEXTrades. click on the below link to verify your account and continue https://annextrades.com/webhook/action.php?id=`+user.registration_id,
                  from: 'whatsapp:+14155238886',
                  to: 'whatsapp:+919055509190'
                })
              .then(message => console.log(message.sid))
              .done(); */
            transporter.sendMail(mailOptions, function (error_2, info) {
              if (error_2) {
                console.info('Email Failed');
                console.log(error_2);

              } else {
                console.info('Email Send');
                console.log('Email sent: ' + info.response);
              }
            });
          }); 
  });
/* }
catch(error){
  console.log(error);
  } */
  }else{
    agent.add('There seems to be an error with the number you provided, please ensure that you entered your 10 digit telephone number.');
    agent.context.set('awaiting_email', 2);
  }
}


  // Run the proper function handler based on the matched Dialogflow intent name
  let intentMap = new Map();

  intentMap.set('71Name', name);
  intentMap.set('72companyname', companyname);
  intentMap.set('73email', email);
  intentMap.set('74phonenumber', phonenumber);
  //intentMap.set('74phonenumber - no', livechat);

  agent.handleRequest(intentMap);

});


app.post('/send-msg', (req, res)=>{
  console.log('ms hye');
  console.log(req.body.text, req.body.mysession);
  runSample(req.body.text, req.body.mysession).then(data=>{
    res.send({reply:data})
  });
});

/**
 * Send a query to the dialogflow agent, and return the query result.
 * @param {string} projectId The project to be used
 */

async function runSample(msg, sessionId) {
  // A unique identifier for the given session

  
  // Create a new session
  var projectId = 'decisive-coder-299313';
  var sessionClient = new dialogflow.SessionsClient( { keyFilename:'./decisive-coder-299313-b06aac026114.json' } );
  var sessionPath = sessionClient.sessionPath(projectId, sessionId);
  console.log('Working');
  // The text query request.
  const request = {
    session: sessionPath,
    queryInput: {
      text: {
        
        text: msg,
        // The language used by the client (en-US)
        languageCode: 'en-US',
      },
    },
  };

  // Send request and log result
  const responses = await sessionClient.detectIntent(request);
  //console.log(responses[0]);
  const result = responses[0].queryResult;
  console.log(`  Query: ${result.queryText}`);
  console.log(`  Response: ${result.fulfillmentText}`);
  if (result.intent) {
    console.log(`  Intent: ${result.intent.displayName}`);
  } else {
    console.log(`  No intent matched.`);
  }
  return result.fulfillmentText;
}
https.createServer(options, app).listen(PORT, '0.0.0.0', ()=> { console.log(`Server is up and running at`+PORT);}
); 