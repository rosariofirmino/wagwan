const user = {
  id: "",
  username: "",
  password: "",
  team: "",
  points: 0,
  total_fountains: 0,
  daily_streak: 0
}

var express = require("express");
var bodyParser = require("body-parser");

const mongoose = require('mongoose');

mongoose.connect('mongodb+srv://admin1:admin1@cluster0.6dbdztl.mongodb.net/?retryWrites=true&w=majority');

var db = mongoose.connection;
db.on('error', console.log.bind(console, "connection error"));
db.once('open', function (callback) {
  console.log("Connection successful");
})

var app = express()
app.use(bodyParser.json());
app.use(express.static('public'));
app.use(bodyParser.urlencoded({
  extended: true
}));

app.post('/sign_up', function (req, res) {
  var username = req.body.username;
  var password = req.body.password;
  var team = req.body.team;

  const user = {
      "id": 0,
      "username": username,
      "password": password,
      "team": team,
      "points": 0,
      "total_fountains": 0,
      "daily_streak": 0
  }

  db.collection('Users').insertOne(data, function (err, collection) {
      if (err) throw err;
      console.log("User created successfully");
  });

  return res.redirect('map.html');
})

app.get('/', function (req, res) {
  res.set({
      'Access-control-Allow-Origin': '*'
  });
  return res.redirect('index.html');
}).listen(8080)

console.log("server listening at port 8080");