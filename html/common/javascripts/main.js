(function() {
    document.getElementById('judge').onsubmit = function() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/judge.php', false);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onreadystatechange = function() {
            if(xhr.readyState !== 4) {
                return;
            }

            if(xhr.status === 200) {
                alert('Correct!');
            } else {
                alert('Incorrect...');
            }
        }

        var payload = {
            problemNo: document.getElementById('problemNo').value,
            flag: document.getElementById('flag').value
        };
        xhr.send(JSON.stringify(payload));

        document.getElementById('flag').value = '';

        return false;
    };
})();
