const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const app = express();
const path = require('path');
const bcrypt = require('bcrypt');
const port = 3000;

// Middleware to parse JSON requests
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));
// Serve Lottie files from the 'data' directory
app.use('/data', express.static(path.join(__dirname, 'data')));
// Specify the view engine (EJS in this case)
app.set('view engine', 'ejs');


// MySQL Connection
// const db = mysql.createConnection({
//   host: 'localhost',
//   user: 'root',
//   password: '',
//   database: 'fintech',
// });

// db.connect((err) => {
//   if (err) {
//     console.error('Error connecting to MySQL:', err);
//     throw err;
//   }
//   console.log('Connected to MySQL');
// });

// functions
app.post('/login', async (req, res) => {
  console.log('Request Body:', req.body);
  try {
    const email = req.body.email;
    const password = req.body.password;
    const sql = 'SELECT * FROM users WHERE email = ?';
    const values = ['chidy@gmail.com'];

    db.query(sql, values, async (error, results, fields) => {
      if (error) {
        console.error('Error executing query: ', error);
        res.status(500).send('Internal Server Error');
      } else {
        if (results.length > 0) {
          const user = results[0];

          // Compare hashed password
          const passwordMatch = await bcrypt.compare('Qwerty', user.password);

          if (passwordMatch) {
            // Passwords match, redirect to dashboard or another route
            res.redirect('/home');
          } else {
            // Passwords do not match
            res.redirect('/login?pswd=error');
          }
        } else {
          // User not found
          res.redirect('/login?user=error');
        }
      }
    });
  } catch (error) {
    console.error('Error during login:', error);
    res.status(500).send('Internal Server Error');
  }
});

app.post('/register', async (req, res) => {
  console.log('Request Body:', req.body);
  try {
    const fullName = req.body.full_name;  // Check the name attribute in the HTML form
    const natId = req.body.natId;
    const mobile = req.body.mobile;
    const email = req.body.email;
    const password = req.body.password;
    const confirmPassword = req.body.confirmPassword;

    // Validate form data
    if (password !== confirmPassword) {
      console.log('Password Do not match');
      res.redirect('/register?pswd=error');
    }

    const hashedPassword = await bcrypt.hash(password, 10);

    const sql = 'INSERT INTO users (full_name, nat_id, mobile, email, password) VALUES (?, ?, ?, ?, ?)';
    // const values = [fullName, natId, mobile, email, password];
    const values = [fullName, natId, mobile, email, hashedPassword];

    db.query(sql, values, (error, results, fields) => {
      if (error) {
        console.error('Error executing query: ', error);
        res.status(500).send('Internal Server Error');
      } else {
        console.log('User successfully inserted into the database');
        res.redirect('/login');
      }
    });
  } catch (error) {
    console.error('Error during registration:', error);
    res.render('register', { error: 'Internal server error during registration.' });
  }
});
// END FUNC
// Define API endpoints
app.get('/users', (req, res) => {
  const query = 'SELECT * FROM users';
  db.query(query, (err, results) => {
    if (err) {
      console.error('Error executing query:', err);
      res.status(500).send('Internal Server Error');
    } else {
      res.json(results);
    }
  });
});
// END API

// pages
app.get('/login', (req, res) => {
  res.render('login');
});
app.get('/register', (req, res) => {
  res.render('register');
});
app.get('/home', (req, res) => {
  res.render('home');
});
app.get('/loans', (req, res) => {
  res.render('loans');
});
app.get('/fund_transfer', (req, res) => {
  res.render('fund_transfer');
});
app.get('/portfolio', (req, res) => {
  res.render('portfolio');
});
app.get('/account', (req, res) => {
  res.render('account');
});
app.get('/connect', (req, res) => {
  res.render('connect');
});
app.get('/chama', (req, res) => {
  res.render('chama');
});
app.get('/deposit', (req, res) => {
  res.render('deposit');
});
app.get('/bill', (req, res) => {
  res.render('bill');
});
app.get('/', (req, res) => {
  const animations = [
    {
      title: 'Animation 1',
      description: 'Description for Animation 1.',
      lottiePath: 'anim_1.json', // Replace with the path to your Lottie JSON file
    },
    {
      title: 'Animation 2',
      description: 'Description for Animation 2.',
      lottiePath: 'anim_2.json', // Replace with the path to your Lottie JSON file
    },
    // Add more animations as needed
  ];

  res.render('index', { animations });
});
app.get('/transactions', (req, res) => {
  const transactions = [
    { date: '2024-02-01', description: 'Purchase 2 wheels', amount: 'KSH 5000' },
    { date: '2024-03-02', description: 'Withdrawal for Chama XYZ', amount: 'KSH 300,000' },
    // Add more transactions as needed
  ];

  res.render('transactions', { transactions });
});
//  END PAGES

app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});