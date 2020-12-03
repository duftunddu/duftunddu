// Source: https://codepen.io/Aceamar/pen/LKLXKK

var containers = document.getElementsByClassName("slideContainer");

for (let i = 0; i < containers.length; i++) {
    slider = containers[i].querySelector(".myRange");
    output = containers[i].querySelector(".value");
    output.innerHTML = slider.value;
    console.log(output);
    slider.oninput = function (e) {
        e.target.parentElement.querySelector(".value").innerHTML = e.target.value;
    }

    slider.addEventListener("input", function (e) {
        console.log("hallo");
        var x = e.target.value;
        // var color = 'linear-gradient(90deg, rgb(128, 128, 128)' + x + '% , rgb(214, 214, 214)' + x + '%)';
        // var color = 'linear-gradient(90deg, rgb(249, 194, 104)' + x + '% , rgb(31, 50, 86)' + x + '%)';
        var color = 'linear-gradient(90deg, rgb(137,22,63)' + x + '% , rgb(247, 244, 251)' + x + '%)';
        e.target.style.background = color;
    });
}