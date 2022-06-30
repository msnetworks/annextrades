const fs = require("fs");
const https = require("https");
const dialogflow = require('dialogflow');
const uuid = require('uuid');
//var sessionId = uuid.v4(); */
const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
var nodemailer = require('nodemailer');
const { WebhookClient } = require('dialogflow-fulfillment');


const PORT = '8080';
const app = express();

const options = {
  key: fs.readFileSync('key.pem'),
  cert: fs.readFileSync('cert.pem')
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
      console.log('name check');

      var validation = /^[a-zA-Z ]+$/;  
      var name = agent.parameters.name;
      var n = name;
      Name = n.name;

      console.log(Name);
      if (validation.test(Name)) {
        agent.add('Please provide your company name:');
      } else {
        agent.add('The system does not ensure you have first and last names – please provide validation to confirm both first and last name.  :');
      }
    }

    async function companyname(agent){
      console.log('company name check');
      var companyname = agent.parameters.companyname;
      console.log(companyname);
      agent.add('Please provide your email:')
    }


    async function email(agent){
      console.log('email check');
      var validation = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
      var email = agent.parameters.email;
      console.log(email);
      if (validation.test(email)) {
        agent.add('Please provide your phone number:')
      } else {
        agent.add('There seems to be something wrong with the email ID you provided, please verify and reenter your email.')
      }
    }


    async function phonenumber(agent){
      console.log('phone check');
      var phonenumber = agent.parameters.phonenumber;
      console.log(phonenumber);
      var phoneno = /^\d{10}$/;
     // const result = validatePhoneNumber.validate(phonenumber);
     // console.log(result);
      if (phoneno.test(phonenumber)) {
        try{
          return new Promise(function (resolve, reject) {
          
          var company_name = agent.context.get('companyname').parameters.companyname;
          var number = agent.parameters.phonenumber;
          const Name = agent.context.get('username').parameters.name;
          var Email = agent.context.get('email').parameters.email; 
          //var Type = agent.context.get('seller').parameters['type']; 
          console.info(`Webhook Check`);
          console.info(Name);
          var n = Name;
          var name = `${n.name}`;
          const regex = /\w+\s\w+(?=\s)|\w+/g;
          const name1 = name;
          const [firstName1, lastName1] = name1.trim().match(regex);
          var firstname = `${firstName1}`;
          var lastname = `${lastName1}`;
          var company = company_name;
          var email = Email;  
          var type = 'Seller';
          var phone = number;

          console.log(`${firstName1} | ${lastName1}`);
          console.log(name);
          console.log(company_name);
          console.log(number);
          console.log(Email);
          console.log(`${firstname}, ${email}, ${company}, ${type}, ${phone}`);
          // agent.add(`${firstname}, ${email}, ${company}, ${type}, ${phone}`); 

          return connectToDatabase()
          .then(connection => {
            console.info(`${name}`);

            var sql = "INSERT INTO `tmp_register` (firstname, lastname, email, phonenumber, company_name, user_type) VALUES (?)";
            var values = [firstname, lastname, email, phone, company, 'seller'];
              
            connection.query(sql, [values], function (error, rows) {
              
                    
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
          //console.log(result);
          result.map(user => {
            agent.add(`Thank you `+user.firstname+`.<br> Please login to email account provided to complete your verification to get started .`);
            //agent.add(`Your Registration ID `+user.registration_id);
            console.info(`Your Registration ID `+user.registration_id);
            //console.log(rows.affectedRows);
            var transporter = nodemailer.createTransport({
              service: 'gmail',
              auth: {
                user: 'annexis.data@gmail.com',
                pass: 'Annexis@786'
              }
            });
            var mailOptions = {
              from: 'welcome@annextrades.com',
              to: email,
              bcc: 'annexis.data@gmail.com',
              subject: user.firstname+' Thanks for joining us on AnnexTrades.',
              html: `
                      <div class="row">
                        <div class="col-3 m-100">&nbsp;</div>
                          <div class="col-6" style="padding: 30px 15px;">
                            <center style="width: 100%; background-color: #fff; border: 2px solid #ff7900;">
                              <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;  mso-hide: all; font-family: sans-serif;">
                              </div>
                              <div style="max-width: 600px; margin: 0 auto;" class="email-container">
                                <!-- BEGIN BODY -->
                                
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
                                      <a href="https://annextrades.com/webhook/action.php?id=`+user.registration_id+`" target="_blank" class="btn btn-primary"><button style="color:#fff; background: #ff7900; border: 0px; padding: 8px 16px;">Verify Email Address</button></a></br>
                                      <h3>Your Bridge to Expansion & Increased Market Share.</h3>
                                    </div>
                                  </td>
                                </tr><!-- end tr -->
                              <!-- 1 Column Text + Button : END -->
                              </table>
                            </div>
                          </center>
                        </div>
                      <div class="col-3 m-100">&nbsp;</div>
                    </div>
                    </body>
                  `
                };
                  /* const accountSid = 'ACb58a027b3adb304956c989c4c0f1d782'; 
                  const authToken = 'a8d030e97dd2153b841ed1ab845880ec'; 
                  const client = require('twilio')(accountSid, authToken); 
                  
                  client.messages 
                    .create({ 
                        body: `Thanks `+firstname+` for registration in ANNEXTrades. click on the below link to verify your account and continue https://annextrades.com/webhook/action.php?id=`+user.registration_id, 
                        from: 'whatsapp:+14155238886',       
                        to: 'whatsapp:+919055509190' 
                      }) 
                    .then(message => console.log(message.sid)) 
                    .done(); */

              transporter.sendMail(mailOptions, function(error, info){
                if (error) {
                  console.info('Email Failed');
                  console.log(error);

                } else {
                  console.info('Email Send');
                  console.log('Email sent: ' + info.response);
                }
            });
          });
        });
      }); 
    }); 
    });
  }
  catch(error){
    console.log(error);
    }
      }else{
        agent.add('There seems to be an error with the number you provided, please ensure that you entered your 10 digit telephone number.');
      }
    }


  // Run the proper function handler based on the matched Dialogflow intent name
  let intentMap = new Map();

  intentMap.set('71Name', name);
  intentMap.set('72companyname', companyname);
  intentMap.set('73email', email);
  intentMap.set('74phonenumber', phonenumber);
  //intentMap.set('8CompanyName', AcceptNSubmit);

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