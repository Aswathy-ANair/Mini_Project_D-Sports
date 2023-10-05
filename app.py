from flask import Flask, render_template, request, redirect, url_for, session
from flask_pymongo import PyMongo
from pymongo import MongoClient
from bson import ObjectId  # Import ObjectId from bson module

app = Flask(__name__)
app.secret_key = 'your_secret_key'  # Set a secret key for session management
app.config['MONGO_URI'] = 'mongodb://localhost:27017/achu'
mongo = PyMongo(app)

# Connect to MongoDB
client = MongoClient('mongodb://localhost:27017/')
db = client['achu']  # Use your database name "achu"

# Create a new admin document function
def create_admin_document():
    admin_data = {
        'email': 'admin@example.com',
        'password': 'adminpas'  # Store the plain text password
    }
    achu1_collection = db['achu1']
    achu1_collection.insert_one(admin_data)

# Route to create and insert admin document
@app.route('/create_admin', methods=['GET'])
def create_admin():
    create_admin_document()
    return 'Admin document created and inserted successfully.'

# Your existing routes and code

@app.route('/login', methods=['GET', 'POST'])
def login():
    alert_message = None
    if request.method == 'POST':
        email = request.form['email']
        password = request.form['password']
        admin_collection = mongo.db.achu1
        admin = admin_collection.find_one({'email': email})
        if admin and admin['password'] == password:
            # Login successful
            # Store the ObjectId in the session
            session['user_id'] = str(admin['_id'])  
            alert_message = "Logged in successfully as admin" # Convert ObjectId to string
            return redirect(url_for('admindash'))
  
        else:
            # Check if the teacher's credentials are valid
            teacher_collection = db['achu2']
            teacher = teacher_collection.find_one({'email': email, 'password': password})

            if teacher:
                # Set a session variable to indicate that the user is logged in as a teacher
                session['user_type'] = 'teacher'
                return redirect(url_for('teacher_home'))  # Redirect to teacher home page for teacher

            # Login failed for both admin and teacher
            return render_template('login.html', error='Invalid credentials')
    return render_template('adminlog.html', alert_message=alert_message)
    

# Inside your 'login' route



@app.route('/admindash')
def admindash():
    if 'user_id' in session:
        user_id = ObjectId(session['user_id'])  # Convert the string back to ObjectId
        admin_collection = mongo.db.achu1
        admin = admin_collection.find_one({'_id': user_id})
        if admin:
            # The user is logged in as an admin, you can access admin details
            return render_template('admindash.html')  # Change the template name here
    # Redirect to login page if the user is not logged in or not found in MongoDB
    return redirect(url_for('login'))

@app.route('/home.html')
def home():
    return render_template('home.html')

@app.route('/adminlog.html')
def admin_login():
    return render_template('adminlog.html')

# Existing code for 'teacher_registration' and 'teacher_home' routes
# ... (Your existing code)
# ... (Your existing code)

# ... (Your existing code)

import re  # Import the 're' module for regular expressions

# ... (Your existing code)

# Existing routes for 'announcements', 'home', and 'admin_login'
# ... (Your existing code)

def is_teacher_logged_in():
    return 'user_id' in session and 'user_type' in session and session['user_type'] == 'teacher'

@app.route('/teacher_home')
def teacher_home():
    if is_teacher_logged_in():
        # You can add logic here for what should be displayed on the teacher's home page
        return render_template('teacher.html')  # Render the 'teacher.html' template
    else:
        return redirect(url_for('admin_login'))  # Redirect to admin login page if not logged in as a teacher

@app.route('/teacher_registration', methods=['GET', 'POST'])
def teacher_registration():
    if request.method == 'POST':
        # Get form data from the request
        name = request.form['name']
        email = request.form['email']
        password = request.form['password']
        confirm_password = request.form['confirm_password']
        mob = request.form['id']
        department = request.form['department']

        # Check if the password and confirm_password match
        if password != confirm_password:
            error = "Password and Confirm Password do not match."
            return render_template('t.html', error=error)

        # Validate phone number (up to 12 digits, no characters)
        if not re.match(r'^\d{1,10}$', mob):
            error = "Invalid phone number. Please enter up to 12 digits with no characters."
            return render_template('t.html', error=error)

        # Validate name (letters only, no numbers or special characters)
        if not re.match(r'^[A-Za-z\s]+$', name):
            error = "Invalid name. Please use letters and spaces only."
            return render_template('t.html', error=error)

        # Validate email format
        if not re.match(r'^\S+@\S+\.\S+$', email):
            error = "Invalid email format. Please enter a valid email address."
            return render_template('t.html', error=error)

        # Check if the email is already registered
        teacher_collection = db['achu2']
        existing_teacher = teacher_collection.find_one({'email': email})

        if existing_teacher:
            error = "Email is already registered. Please use a different email."
            return render_template('t.html', error=error)

        # Create a dictionary with the form data
        teacher_data = {
            'name': name,
            'email': email,
            'password': password,
            'mob': mob,
            'department': department
        }

        # Insert the data into the MongoDB collection for teachers
        teachers_collection = db['achu2']  # Use a separate collection for teachers
        teachers_collection.insert_one(teacher_data)

        # Redirect to the teacher_home route on successful registration
        return redirect(url_for('teacher_home'))

    return render_template('t.html')
# In your Flask application
# Add this route to your Flask application





if __name__ == '__main__':
    app.debug = True
    app.run()
