const express = require("express");
const cors = require("cors");
const helmet = require("helmet");
const rateLimit = require("express-rate-limit");
let supertokens = require("supertokens-node");
let Session = require("supertokens-node/recipe/session");
let {
  verifySession,
} = require("supertokens-node/recipe/session/framework/express");
let {
  middleware,
  errorHandler,
} = require("supertokens-node/framework/express");
let Passwordless = require("supertokens-node/recipe/passwordless");
let { mailTransporter, getEmailBody } = require("./mailer");
require("dotenv").config();
const APP_NAME = process.env.APP_NAME || "demo-App";
const apiPort = process.env.PORT || 3000;

supertokens.init({
  framework: "express",
  supertokens: {
    // connection details for your supertokens core
    connectionURI: process.env.SUPERTOKENS_CONNECTION_URI,
    apiKey: process.env.SUPERTOKENS_API_KEY,
  },
  appInfo: {
    // learn more about this on https://supertokens.com/docs/session/appinfo
    appName: "demo-app",
    apiDomain: "http://localhost:3000",
    websiteDomain: "http://localhost:4200",
    apiBasePath: "/auth",
    websiteBasePath: "/",
  },
  recipeList: [
    Passwordless.init({
      flowType: "USER_INPUT_CODE_AND_MAGIC_LINK",
      contactMethod: "EMAIL",
      createAndSendCustomEmail: async (input) => {
        let htmlBody = getEmailBody(
          APP_NAME,
          Math.ceil(input.codeLifetime / 1000 / 60),
          input.urlWithLinkCode,
          input.userInputCode,
          input.email
        );
        await mailTransporter.sendMail({
          html: htmlBody,
          to: input.email,
          from: `Team Supertokens <${process.env.NODEMAILER_USER}>`,
          sender: process.env.NODEMAILER_USER,
          subject: `Login to ${APP_NAME}`,
        });
      },
    }),
    Session.init(), // initializes session features
  ],
});

const app = express();

const limiter = rateLimit({
  windowMs: 15 * 60 * 1000,
  max: 100,
});

// security middlewares
app.use(helmet());
app.use(limiter);

// ...other middlewares
app.use(
  cors({
    origin: "http://localhost:4200",
    allowedHeaders: ["content-type", ...supertokens.getAllCORSHeaders()],
    methods: ["GET", "PUT", "POST", "DELETE"],
    credentials: true,
  })
);

app.use(middleware());

// custom API that requires session verification
app.get("/sessioninfo", verifySession(), async (req, res) => {
  let session = req.session;
  res.send({
      sessionHandle: session.getHandle(),
      userId: session.getUserId(),
      accessTokenPayload: session.getAccessTokenPayload(),
  });
});

app.use(errorHandler());

app.use((err, req, res, next) => {
  res.status(500).send("Internal error: " + err.message);
});

if (require.main === module) {
  app.listen(apiPort, () =>
    console.log(`API Server listening on port ${apiPort}`)
  );
}

module.exports = app;
