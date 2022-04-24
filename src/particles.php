<!DOCTYPE html>

<style>
    canvas {
        display: block;
        vertical-align: bottom;
    }

    #particles-js {
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: #ffffff;
        background-image: url("");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: 50% 50%;
    }

    .navbarz {
        z-index: 3;
    }

    .container_row {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        flex-direction: column;
    }

    .layer1 {
        position: absolute;
        z-index: 2;
        width: 100%;
    }

    .layer1, .smthin {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    h3 {
        text-align: center;
    }

    .smthin {
        width: 60%;
    }

    .layer2 {
        z-index: 1;
        position: relative;
        height: 80% !important;
        width: 100%;
    }
</style>


<script>
    particlesJS("particles-js", {
        "particles": {
            "number": {
                "value": 40,
                "density": {
                    "enable": true,
                    "value_area": 800
                }
            },
            "color": {
                "value": "#000000"
            },
            "shape": {
                "type": "circle",
                "stroke": {
                    "width": 0,
                    "color": "#000000"
                },
                "polygon": {
                    "nb_sides": 5
                },
                "image": {
                    "src": "img/github.svg",
                    "width": 100,
                    "height": 100
                }
            },
            "opacity": {
                "value": 0.5,
                "random": false,
                "anim": {
                    "enable": false,
                    "speed": 1,
                    "opacity_min": 0.1,
                    "sync": false
                }
            },
            "size": {
                "value": 3,
                "random": true,
                "anim": {
                    "enable": false,
                    "speed": 1,
                    "size_min": 0.1,
                    "sync": false
                }
            },
            "line_linked": {
                "enable": true,
                "distance": 150,
                "color": "#000000",
                "opacity": 0.4,
                "width": 1
            },
            "move": {
                "enable": true,
                "speed": 1,
                "direction": "none",
                "random": false,
                "straight": false,
                "out_mode": "out",
                "bounce": false,
                "attract": {
                    "enable": false,
                    "rotateX": 600,
                    "rotateY": 1200
                }
            }
        },
        "interactivity": {
            "detect_on": "canvas",
            "events": {
                "onhover": {
                    "enable": false,
                    "mode": "grab"
                },
                "onclick": {
                    "enable": false,
                    "mode": "push"
                },
                "resize": true
            }
        },
        "retina_detect": true
    });
</script>