// Feedback on like input
function like_feedback() {
    var x, text;

    // Get the value of the input field
    x = document.getElementById("like").value;

    // X feedback
    // if (isNaN(x) || x < 1 || x > 10) {
    if (x > 90) {
        text = "I love it! I'll buy it.";
    }
    else if (x > 80) {
        text = "I love wearing it. I'd like to buy it.";
    }
    else if (x > 70) {
        text = "It smells great. Maybe... I'll buy it?";
    }
    else if (x > 60) {
        text = "It's good.";
    }
    else if (x > 50) {
        text = "It's okay.";
    }
    else if (x > 40) {
        text = "It's kinda average.";
    }
    else if (x > 30) {
        text = "I don't like it.";
    }
    else if (x > 20) {
        text = "Hmmm... Not my taste.";
    }
    else if (x > 10) {
        text = "Uh... No.";
    }
    else {
        text = "Ugh! I am about to puke.";
    }
    document.getElementById("like-feedback").innerHTML = text;
}