window.addEventListener("DOMContentLoaded", () => {
    // Retrieve the slider elements from the HTML
    const widthSlider = document.getElementById("widthSlider");
    const heightSlider = document.getElementById("heightSlider");
    const depthSlider = document.getElementById("depthSlider");
  
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
    const renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth / 2, window.innerHeight / 2);
    renderer.setClearColor(0xffffff);
    var canvasContainer = document.getElementById("canvas-container");
    canvasContainer.appendChild(renderer.domElement);
  
    // Create the initial rectangle geometry
    const initialWidth = 5;
    const initialHeight = 5;
    const initialDepth = 5;
    const rectangleGeometry = new THREE.BoxGeometry(
      initialWidth,
      initialHeight,
      initialDepth
    );
    const rectangleMaterial = new THREE.MeshPhongMaterial({ color: 0x00a0f7 });
    const rectangle = new THREE.Mesh(rectangleGeometry, rectangleMaterial);
    scene.add(rectangle);
  
    // Function to update the rectangle dimensions based on slider values
    function updateRectangleDimensions() {
      const width = parseInt(widthSlider.value);
      const height = parseInt(heightSlider.value);
      const depth = parseInt(depthSlider.value);
      rectangle.scale.set(
        width / initialWidth,
        height / initialHeight,
        depth / initialDepth
      );
    }
  
    // Event listeners for slider changes
    widthSlider.addEventListener("input", updateRectangleDimensions);
    heightSlider.addEventListener("input", updateRectangleDimensions);
    depthSlider.addEventListener("input", updateRectangleDimensions);
  
    // Position the camera
    camera.position.z = 10;
  
    // Add ambient light to the scene
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
    scene.add(ambientLight);
  
    // Add directional light to the scene
    const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
    directionalLight.position.set(1, 1, 1).normalize();
    scene.add(directionalLight);
  
    // Animation loop
    function animate() {
      requestAnimationFrame(animate);
      renderer.render(scene, camera);
      rectangle.rotation.x += 0.0; // Rotate the rectangle for visual interest
      rectangle.rotation.y += 0.004;
    }
    animate();
  });
  
  // Exibir Valores input
  function updateValue(span, value) {
    document.getElementById(span).innerText = value + "m";
  }
  
  function formatDate(input) {
    let value = input.value;
    value = value.replace(/\D/g, '');
  
    if (value.length > 4) {
      value = value.replace(/^(\d{4})(\d{2})(\d{0,2})(\d{0,2})$/, '$1-$2-$3');
    } else if (value.length > 2) {
      value = value.replace(/^(\d{4})(\d{0,2})$/, '$1-$2');
    }
    
    input.value = value;
  }
  