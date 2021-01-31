var containers = document.getElementsByClassName("slideContainer-spray");

for (let i = 0; i < containers.length; i++) {
    slider = containers[i].querySelector(".spray");
    output = containers[i].querySelector(".value");
    output.innerHTML = slider.value;
    console.log(output);
    slider.oninput = function (e) {
        e.target.parentElement.querySelector(".value").innerHTML = e.target.value;
    }

    slider.addEventListener("input", function (e) {
        console.log("hallo");
        var x = e.target.value * 12.5;
        var color = 'linear-gradient(90deg, rgb(16, 24, 32)' + x + '% , rgb(247, 244, 251)' + x + '%)';
        e.target.style.background = color;
    });
}