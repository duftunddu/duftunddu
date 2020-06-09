var slider = document.getElementById("sweat_id");
var output = document.getElementById("value");

output.innerHTML = slider.value;

slider.oninput = function () {
    output.innerHTML = this.value;
}


slider.addEventListener("mousemove", function () {
    console.log("hallo");
    var x = slider.value;
    var color = 'linear-gradient(90deg, rgb(153, 153, 255)' + x + '% , rgb(214, 214, 214)' + x + '%)';
    // var color = 'linear-gradient(90deg, rgb(117, 252, 117)' + x + '% , rgb(214, 214, 214)' + x + '%)';
    slider.style.background = color;
});