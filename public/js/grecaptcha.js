
grecaptcha.ready(function () {
    grecaptcha.execute('6Lf3TpUUAAAAAM0ToNr9KwwbuQbqpHqo6vyTscpu', {action: 'homepage'}).then(function (token) {
        var recaptcha = document.getElementById('recaptcha');
        recaptcha.value = token;
    });
});