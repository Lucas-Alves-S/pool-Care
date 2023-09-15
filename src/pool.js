let rectangle;
function objeto() {
    // Set up the Three.js scene
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(
        90,
        window.innerWidth / window.innerHeight,
        0.1,
        10
    );
    camera.position.set(0, 0, 10);

    // Set up the Three.js renderer
    var canvasContainer = document.getElementById("canvas-container");

    const renderer = new THREE.WebGLRenderer();
    renderer.setSize(canvasContainer.clientWidth, window.innerHeight / 2);
    renderer.setClearColor(0x202c3c);
    canvasContainer.appendChild(renderer.domElement);

    // Add ambient light to the scene
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
    scene.add(ambientLight);

    // Add directional light to the scene
    const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
    directionalLight.position.set(1, 1, 1).normalize();
    scene.add(directionalLight);

    const rectangleGeometry = new THREE.BoxGeometry(width, height, length);
    const material = new THREE.MeshPhongMaterial({ color: 0x7e7e87 });
    rectangle = new THREE.Mesh(rectangleGeometry, material);
    scene.add(rectangle);

    // Animation loop
    function animate() {
        requestAnimationFrame(animate);
        renderer.render(scene, camera);
        rectangle.rotation.y += 0.004;
    }
    animate();
}

window.addEventListener('DOMContentLoaded', objeto);


function newColor() {
    event.preventDefault();
    const ph = document.getElementById("ph").value;
    const cloro = document.getElementById("cloro").value;
    if (ph < 7.2) {
        rectangle.material.color.setHex(0x8d54b3);
        document.getElementById('alert').innerText = "A água da sua piscina está ácida, o nível de P.H. está baixo!"
    } else if (ph > 7.6) {
        rectangle.material.color.setHex(0xb35454);
        document.getElementById('alert').innerText = "A água da sua piscina está básica, o nível de P.H. está alto!"
    } else {
        rectangle.material.color.setHex(0x00a0f7);
        document.getElementById('alert').innerText = "A água da sua piscina está boa, o nível de P.H. está ideal!"
    }

    if (cloro < 1) {
        document.getElementById('alertCloro').innerText = "Nível de Cloro muito Baixo!"
    } else if (cloro > 3) {
        document.getElementById('alertCloro').innerText = "Nível de Cloro muito Alto!"
    } else {
        document.getElementById('alertCloro').innerText = "Nível de Cloro Ideal!"
    }
    return false;
}

const form = document.getElementById('formulario');
form.addEventListener('submit', newColor);