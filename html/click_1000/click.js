(function() {
    var counter = document.getElementById('counter');
    var theButton = document.getElementById('theButton');

    var source = '!#$%&=~|-^()[]{}0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var indices = [57,63,52,58,92,61,70,86,112,44,86,104,48,108,44,40,38,30,156,75,55,93];
    var modulo = 78;

    counter.innerText = '0';

    var createMessage = function(source, indices, modulo) {
        var message = '';
        for(var i = 0; i < indices.length; i++) {
            var message = message + source[indices[i] % modulo];
        }
        return message;
    };

    theButton.onclick = function() {
        var counter = document.getElementById('counter');
        var currentCount = counter.innerText * 1;
        var newCount = currentCount + 1;
        counter.innerText = newCount;

        if(newCount >= 1000) {
            alert(createMessage(source, indices, modulo));
            theButton.onclick = function() {return false};
        }
    };
})();
