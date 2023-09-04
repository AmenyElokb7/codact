<!DOCTYPE html>
<html>
<head>
    <title>Live</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        canvas {
            width: 100%;
            height: 100%;
        }
        #background {
        position: absolute;
        width: 100%;
        height: 100%;
        background-image: url('assets/images/background.jpg');
        background-size: cover;
        background-position: center;
    }
    </style>
 <script src="https://cdn.babylonjs.com/babylon.js"></script>
 <script src="https://cdn.babylonjs.com/loaders/babylonjs.loaders.js"></script>

</head>
<body>

    <canvas id="canvas"></canvas>

    <script>
        const canvas = document.getElementById('canvas');
        const engine = new BABYLON.Engine(canvas);

        const scene = new BABYLON.Scene(engine);
        scene.clearColor = new BABYLON.Color4(0, 0, 0, 0); // Background color

        const camera = new BABYLON.ArcRotateCamera('camera', 0, 0, 0, new BABYLON.Vector3(0, 0, 0), scene);
        camera.setPosition(new BABYLON.Vector3(0, 5, -10));
        camera.attachControl(canvas, true);

        const light = new BABYLON.HemisphericLight('light', new BABYLON.Vector3(0, 1, 0), scene);
        light.intensity = 0.7; // Adjust the light intensity as needed
         // Add a skybox to the scene
         const skyboxSize = 1000; // Adjust the size of the skybox cube as needed
        const skyboxTexture = new BABYLON.CubeTexture("path/to/skybox", scene, ["front.jpg", "back.jpg", "up.jpg", "down.jpg", "left.jpg", "right.jpg"]);
        scene.createDefaultSkybox(skyboxTexture, true, skyboxSize);
        
        // Load the scene model
        BABYLON.SceneLoader.ImportMesh('', '', "scene.gltf", scene, function (meshes) {
            console.log('Model imported:', meshes);

            // Find the table mesh in the scene
            const tableMesh = meshes.find(mesh => mesh.name === 'Table');

            // Clone the first mesh and add clones to the scene
            const mesh = meshes[0];
            const spaceBetweenClones = 5;
            const num_tables = parseInt("{{ $coffe->tablesno }}", 10); // Explicitly specify the base as 10 for parsing
            console.log(num_tables); // Verify the value of num_tables in the console
            const numRows = Math.ceil(num_tables / 5); // Number of rows of tables
            const numColumns = 5; // Number of columns of tables

            const totalRows = numRows; // Modify this variable to change the number of rows dynamically
            const totalColumns = numColumns; // Modify this variable to change the number of columns dynamically

            for (let row = 0; row < totalRows; row++) {
                for (let col = 0; col < totalColumns; col++) {
                    if (row * numColumns + col >= num_tables) {
                        break; // Stop creating clones if the required number of tables is reached
                    }

                    const clone = mesh.clone(`Clone_${row}_${col}`);
                    clone.position.x = 3.5 * col * (spaceBetweenClones + clone.getBoundingInfo().boundingBox.extendSize.x);
                    clone.position.z = 3.5 * row * (spaceBetweenClones + clone.getBoundingInfo().boundingBox.extendSize.z);

                    // Create a cylinder mesh for the circle
                    const radius = 0.5;
                    const height = 0.5; // Adjust the height as desired
                    const tessellation = 32;
                    const circle = BABYLON.MeshBuilder.CreateCylinder(`Circle_${row}_${col}`, { height: height, diameterTop: radius * 2, diameterBottom: radius * 2, tessellation: tessellation }, scene);

                    // Set the parent of the circle mesh to the table mesh
                    circle.parent = clone;

                    // Position and rotate the circle mesh on the table
                    circle.position.y = 4.5; // Adjust the height placement of the circle on the table

                    // Create a white material for the circle
                    const whiteMaterial = new BABYLON.StandardMaterial(`WhiteMaterial_${row}_${col}`, scene);
                    whiteMaterial.emissiveColor = BABYLON.Color3.White(); // Set the emissive color to white
                    circle.material = whiteMaterial;
                }
            }
        });

        engine.runRenderLoop(function () {
            scene.render();
        });
    </script>
</body>
</html>
