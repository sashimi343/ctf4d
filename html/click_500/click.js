(function() {
    var counter = document.getElementById('counter');
    var theButton = document.getElementById('theButton');

    counter.innerText = '0';

    theButton.onclick = function() {
        var counter = document.getElementById('counter');
        var currentCount = counter.innerText * 1;
        var newCount = currentCount + 1;
        counter.innerText = newCount;

        if(newCount >= 500) {
            alert('FLAG{var_JS=sugoi;}');
            theButton.onclick = function() {return false};
        }
    };
})();
