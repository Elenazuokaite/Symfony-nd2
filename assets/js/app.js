require('../css/app.scss');
const axios = require('axios');

let myData = document.getElementById('data');
if (typeof test1 !== "undefined") {
    axios.get('data.json')
        .then(function (response) {
            console.log(response.data);
            let data = response.data;
        })
        .catch(function (error) {
            console.error(error);
        });
}