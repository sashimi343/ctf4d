(function() {
    document.getElementById('encoder').onsubmit = function() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/cpattack/encoder.php', false);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if(xhr.readyState !== 4) {
                return;
            }

            if(xhr.status === 200) {
                document.getElementById('ciphertext').value = xhr.responseText;
            }
        };

        var plaintext = document.getElementById('plaintext').value;
        console.log(plaintext);
        var payload = 'plaintext=' + encodeURIComponent(plaintext);
        xhr.send(payload);

        return false;
    };
})();
