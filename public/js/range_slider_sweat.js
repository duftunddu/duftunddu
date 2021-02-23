var containers = document.getElementsByClassName("slideContainer-sweat");

for (let i = 0; i < containers.length; i++) {
    slider = containers[i].querySelector(".sweat");
    output = containers[i].querySelector(".value");
    output.innerHTML = slider.value;
    console.log(output);
    slider.oninput = function (e) {
        e.target.parentElement.querySelector(".value").innerHTML = e.target.value;
    }

    slider.addEventListener("input", function (e) {
        console.log("hallo");
        var x = e.target.value;
        var color = 'linear-gradient(90deg, rgba(253,218,198,255)' + x + '% , rgb(247, 244, 251)' + x + '%)';
        e.target.style.background = color;
    });
}