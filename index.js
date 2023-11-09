const express = require("express");

const app = express();
const bodyParser = require("body-parser");
const mysql = require("mysql");

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

const connection = mysql.createConnection({
  host: process.env.DB_HOST,
  user: process.env.DB_USERNAME,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_DBNAME,
});

connection.connect((err) => {
  if (err) throw err;
  console.log("Connected to the MySQL database");
});

app.post("/users", (req, res) => {
  const username = req.body.username;
  const password = req.body.password;
  const sql = `INSERT INTO bank (username, password) VALUES ('${username}', '${password}')`;
  connection.query(sql, (err, result) => {
    if (err) throw err;
    console.log("User inserted");
    res.sendFile(__dirname + "/success.html");
  });
});

app.get("/", function (req, res) {
  res.sendFile(__dirname + "/index.html");
});

app.get("/admin", (req, res) => {
  res.sendFile(__dirname + "/admin.html");
});

app.listen(3000, () => {
  console.log("Server started on port 3000");
});
