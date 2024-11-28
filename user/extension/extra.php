<style>
    form {
    display: inline-flex;
    align-items: center;
    gap: 10px; /* Space between input and button */
}

form input[type="text"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 20px; /* Rounded corners */
    font-size: 16px;
    width: 200px; /* Set a width for the input */
    transition: border-color 0.3s;
}

form input[type="text"]:focus {
    border-color: #4faef8; /* Highlight border when focused */
    outline: none;
}

form button {
    background-color: #4faef8;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 20px; /* Rounded corners for the button */
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
}

form button:hover {
    background-color: #3a8cc4; /* Slightly darker blue on hover */
    transform: scale(1.05); /* Slight zoom effect on hover */
}

form button:focus {
    outline: none;
}
</style>