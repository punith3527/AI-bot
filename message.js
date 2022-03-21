const express = require("express");

const mysql = require("mysql");
const http = require('http');
//import path from 'path';
/*import { fileURLToPath } from 'url';
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);*/



//ML algo

const app = express();

const db = mysql.createConnection({
    host: process.env.DATABASE_HOST,
    user: process.env.DATABASE_USER,
    password: process.env.DATABASE_PASSWORD,
    database: process.env.DATABASE,
    port: 3307
});

const publicDirectory = path.join(__dirname, './public' );
app.use(express.static(publicDirectory));

app.use(express.urlencoded({ extended: false}));
app.use(express.json());


db.connect( (error) => {
    if(error) {
        console.log(error)
    } else {
        console.log("MYSQL Connected...")
    }
})


app.listen(5004, () => {
    console.log("Server started on Port 5004");
})  