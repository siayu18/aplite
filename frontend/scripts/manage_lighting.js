let lastBrightness = 70;                 // initial slider value
let lastTimestamp = Date.now();          // when session starts
let weightedSum = 0;
let totalSeconds = 0;

function updateUI(value) {
    value = parseInt(value);
    
    const now = Date.now();
    const elapsedSeconds = (now - lastTimestamp) / 1000;

    // Accumulate brightness × time
    weightedSum += lastBrightness * elapsedSeconds;
    totalSeconds += elapsedSeconds;

    // Update tracking state
    lastBrightness = value;
    lastTimestamp = now;

    document.getElementById("currentBrightness").innerText = value + "%";

    document.getElementById("brightnessValue").innerText = value + "%";

    const energySaved = 100 - value;
    document.getElementById("energySaved").innerText = energySaved + "%";

    let pointsText = "None";

    if (value <= 50) {
        pointsText = "High";
    } else if (value <= 60) {
        pointsText = "Medium";
    } else if (value <= 70) {
        pointsText = "Low";
    }

    document.getElementById("pointsPotential").innerText = pointsText;
}

function finalizeAverageBrightness() {
    const now = Date.now();
    const elapsedSeconds = (now - lastTimestamp) / 1000;

    // Capture final segment
    weightedSum += lastBrightness * elapsedSeconds;
    totalSeconds += elapsedSeconds;

    if (totalSeconds === 0) return lastBrightness;

    return Math.round(weightedSum / totalSeconds);
}

function injectAverageBrightness() {
    const avg = finalizeAverageBrightness();

    const points = calculatePoints(avg, totalSeconds);

    const avgInput = document.createElement("input");
    avgInput.type = "hidden";
    avgInput.name = "averageBrightness";
    avgInput.value = avg;

    const pointsInput = document.createElement("input");
    pointsInput.type = "hidden";
    pointsInput.name = "pointsEarned";
    pointsInput.value = points;

    const form = document.querySelector("form");
    form.appendChild(avgInput);
    form.appendChild(pointsInput);
}


function calculatePoints(avgBrightness, totalSeconds) {
    let pointsPerUnit = 0;

    if (avgBrightness <= 50) {
        pointsPerUnit = 45;
    } else if (avgBrightness <= 60) {
        pointsPerUnit = 30;
    } else if (avgBrightness <= 70) {
        pointsPerUnit = 15;
    } else {
        return 0;
    }

    // TEMP: 5 seconds per "hour", change to 3600 if hour
    const unitSeconds = 5;

    const unitsCompleted = Math.floor(totalSeconds / unitSeconds);

    return unitsCompleted * pointsPerUnit;
}