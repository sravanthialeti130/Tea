const express = require('express');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

app.use(bodyParser.urlencoded({ extended: true }));

// Sample user data (replace this with your actual user data storage)
let users = [];

// Route to serve the sign-up page
app.get('/signup', (req, res) => {
    res.sendFile(__dirname + '/signup.html');
});

// Route to handle sign-up form submission
app.post('/signup', (req, res) => {
    const { email, password } = req.body;
    // Check if the user already exists
    if (users.find(user => user.email === email)) {
        res.status(400).send('User already exists');
    } else {
        // Add the new user to the user data
        users.push({ email, password });
        res.redirect('/login'); // Redirect to the login page after sign-up
    }
});

app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});
