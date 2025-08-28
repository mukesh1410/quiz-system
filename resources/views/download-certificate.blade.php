<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Certificate</title>
<style>
    body {
        font-family: 'Helvetica', sans-serif;
        background-color: #f9fafb;
        text-align: center;
        padding: 40px;
    }
    .container {
        border: 8px solid #5a67d8; /* Indigo color */
        background-color: #f7fafc;
        padding: 40px;
        max-width: 600px;
        margin: auto;
        border-radius: 20px;
    }
    h1 {
        font-size: 3rem;
        color: #2f855a; /* green-700 */
        margin-bottom: 1rem;
    }
    h2 {
        font-size: 2rem;
        color: #4a5568; /* gray-700 */
        margin-bottom: 1rem;
    }
    p {
        font-size: 1.25rem;
        color: #4a5568;
        margin-top: 1rem;
    }
    svg {
        fill: #cbd5e0; /* gray-300 */
        margin-bottom: 1rem;
    }
</style>
</head>
<body>
    <div class="container">
        <h1>
            <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px">
                <path d="m385-412 36-115-95-74h116l38-119 37 119h117l-95 74 35 115-94-71-95 71ZM244-40v-304q-45-47-64.5-103T160-560q0-136 92-228t228-92q136 0 228 92t92 228q0 57-19.5 113T716-344v304l-236-79-236 79Zm236-260q109 0 184.5-75.5T740-560q0-109-75.5-184.5T480-820q-109 0-184.5 75.5T220-560q0 109 75.5 184.5T480-300ZM304-124l176-55 176 55v-171q-40 29-86 42t-90 13q-44 0-90-13t-86-42v171Zm176-86Z"/>
            </svg>
            Certificate of Completion
        </h1>
        <p>This is clarify data</p>
        <h2>{{ $data['name'] }}</h2>
        <p>has successfully completed the</p>
        <h3>{{ $data['quiz'] }}</h3>
        <p>{{ $data['date'] }}</p>
    </div>
</body>
</html>
