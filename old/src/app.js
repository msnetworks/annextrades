const fs = require("fs");
const https = require("https");
const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const env = require('dotenv').config();
const axios = require('axios');
var nodemailer = require('nodemailer');
const { WebhookClient } = require('dialogflow-fulfillment');
const {Card, Suggestion} = require('dialogflow-fulfillment');

const options = {
  key: fs.readFileSync("server.key"),
  cert: fs.readFileSync("server.cert")
};


const app = express();
app.use(bodyParser.urlencoded({
    extended: false
}));

app.use(bodyParser.json());

app.get('/', (req, res) => { res.send(`Hello World.!`); });

// Dialogflow route
app.post('/webhook', function (req, res,) {
      
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
          
      function queryDatabase(connection){
        return new Promise((resolve, reject) => {
          connection.query('SELECT * FROM tmp_register ORDER BY id DESC LIMIT 1', (error, results, fields) => {
            resolve(results);
          });
        });
      }
      async function AcceptNSubmit(agent){
        try{
        return new Promise(function (resolve, reject) {
          console.info(`Webhook Check`);

          var company_name = agent.context.get('companydetails').parameters.company_name;
          var number = agent.context.get('companydetails').parameters.number;
          const Name = agent.context.get('names').parameters.name;
          var Email = agent.context.get('companydetails').parameters.email; 
          var Type = agent.context.get('seller').parameters['type']; 
          var n = Name;
          var name = `${n.name}`;
          const regex = /\w+\s\w+(?=\s)|\w+/g;
          const name1 = name;
          const [firstName1, lastName1] = name1.trim().match(regex);
          var firstname = `${firstName1}`;
          var lastname = `${lastName1}`;
          var company = company_name;
          var email = Email;  
          var type = Type;
          var phone = number;

          console.log(`${firstName1} | ${lastName1}`);
          console.log(name);
          console.log(company_name);
          console.log(number);
          console.log(Email);
          console.log(Type);
          console.log(`${firstname}, ${email}, ${company}, ${type}, ${phone}`);
          // agent.add(`${firstname}, ${email}, ${company}, ${type}, ${phone}`); 

          return connectToDatabase()
          .then(connection => {
            console.info(`${name}`);

            var sql = "INSERT INTO `tmp_register` (firstname, lastname, email, phonenumber, company_name, user_type) VALUES (?)";
            var values = [firstname, lastname, email, phone, company, type];
              
            connection.query(sql, [values], function (error, rows) {
              
                    
      resolve();
      return;
      });
      return connectToDatabase()
      .then(connection => {
        return queryDatabase(connection).then(result => {
          console.log(result);
          result.map(user => {
            agent.add(`Thank you `+user.firstname+` for registration.`);
            agent.add(`Your Registration ID `+user.registration_id);
            agent.add(`Please verify your email, and start your business.`);
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
              subject: 'Sending Email using Node.js',
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
                                        <a href="https://annextrades.com/webhook?id=`+user.registration_id+`" target="_blank" class="btn btn-primary"><button style="color:#fff; background: #ff7900; border: 0px; padding: 8px 16px;">Verify Email Address</button></a></br>
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
  }
      
        // Run the proper function handler based on the matched Dialogflow intent name
        let intentMap = new Map();
        
        intentMap.set('submit', AcceptNSubmit);

        agent.handleRequest(intentMap);

    });

https.createServer(options, app).listen(8080, '0.0.0.0', ()=> { console.log(`Server is up and running at 8080`);}
);