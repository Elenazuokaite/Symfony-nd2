
const axios = require('axios');

function validateInput(id) {
    let validationResult = document.getElementById(this.id + 'Validation');
   
        axios.post(validationResult.dataset.path, { input: this.value })
                .then(function (response) {
                        if (response.data.valid) {
                            validationResult.innerText = ":)";
                                        } else {
                                            validationResult.innerText = ":(";
                            }
                    })
                .catch(function (error) {
                        validationResult.innerText = 'Error: ' + error;
                    });

    };

document.getElementById('name').onkeyup = validateInput;
document.getElementById('team').onkeyup = validateInput;

