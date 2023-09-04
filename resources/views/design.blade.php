<!DOCTYPE html>
<html>
<head>
    <title>Babylon.js Model with Colorful Tables</title>
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
        scene.clearColor = new BABYLON.Color4(67/255, 175/255, 215/255, 0.59); // Background color

        const camera = new BABYLON.ArcRotateCamera('camera', 0, 0, 0, new BABYLON.Vector3(0, 0, 0), scene);
        camera.setPosition(new BABYLON.Vector3(0, 5, -10));
        camera.attachControl(canvas, true);

        // Add a light source
        const light = new BABYLON.HemisphericLight("light", new BABYLON.Vector3(0, 1, 0), scene);

        let tableMeshes = []; // Array to store the loaded table meshes

        // Load the scene model
        BABYLON.SceneLoader.ImportMesh('', '', "scene.gltf", scene, function (meshes) {
            console.log('Model imported:', meshes);

            // Find the table meshes in the scene and store them in the tableMeshes array
            tableMeshes = meshes.filter(mesh => mesh.name.startsWith('Table_'));

            // Call the function to add clones to the scene
            addTableClones();
        });

        function addTableClones() {
            const spaceBetweenClones = 5;
            const num_tables = 10; // Explicitly specify the base as 10 for parsing
            console.log(num_tables); // Verify the value of num_tables in the console
            const numRows = Math.ceil(num_tables / 5); // Number of rows of tables
            const numColumns = 5; // Number of columns of tables

            const totalRows = 2; // Set to 2 to have 2 rows of tables
            const totalColumns = 5; // Set to 5 to have 5 tables in each row

            for (let row = 0; row < totalRows; row++) {
                for (let col = 0; col < totalColumns; col++) {
                    if (row * numColumns + col >= num_tables) {
                        break; // Stop creating clones if the required number of tables is reached
                    }

                    const tableMesh = tableMeshes[row * numColumns + col];
                    if (!tableMesh) continue; // In case there are fewer table meshes than expected

                    const clone = tableMesh.clone("Clone_${row}_${col}");
                    clone.position.x = 3.5 * col * (spaceBetweenClones + clone.getBoundingInfo().boundingBox.extendSize.x);
                    clone.position.z = 3.5 * row * (spaceBetweenClones + clone.getBoundingInfo().boundingBox.extendSize.z);

                    // Set a random color for the table
                    const randomColor = new BABYLON.Color3(Math.random(), Math.random(), Math.random());
                    const tableMaterial = new BABYLON.StandardMaterial("TableMaterial_${row}_${col}", scene);
                    tableMaterial.diffuseColor = randomColor;
                    clone.material = tableMaterial;

                    // Create a cylinder mesh for the circle
                    const radius = 0.5;
                    const height = 0.5; // Adjust the height as desired
                    const tessellation = 32;
                    const circle = BABYLON.MeshBuilder.CreateCylinder("Circle_${row}_${col}", { height: height, diameterTop: radius * 2, diameterBottom: radius * 2, tessellation: tessellation }, scene);

                    // Set the parent of the circle mesh to the table mesh
                    circle.parent = clone;

                    // Position and rotate the circle mesh on the table
                    circle.position.y = 4.5; // Adjust the height placement of the circle on the table

                    // Create a white material for the circle
                    const whiteMaterial = new BABYLON.StandardMaterial("WhiteMaterial_${row}_${col}", scene);
                    whiteMaterial.emissiveColor = BABYLON.Color3.White(); // Set the emissive color to white
                    circle.material = whiteMaterial;
                }
            }
        }

        engine.runRenderLoop(function () {
            scene.render();
        });
    </script>
</body>
</html>
