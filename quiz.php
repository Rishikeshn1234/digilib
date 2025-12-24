<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>GM University Physics Quiz</title>

<style>
    * {
        box-sizing: border-box;
        font-family: "Segoe UI", Arial, sans-serif;
    }

    body {
        margin: 0;
        background-color: #6b1f1f;
        padding: 30px;
    }

    .quiz-container {
        max-width: 900px;
        margin: auto;
        background: #ffffff;
        border-radius: 12px;
        padding: 30px;
    }

    .quiz-header {
        text-align: center;
        border-bottom: 3px solid #d4af37;
        padding-bottom: 20px;
        margin-bottom: 30px;
    }

    .quiz-header img {
        width: 120px;
        margin-bottom: 10px;
    }

    .quiz-header h1 {
        margin: 5px 0;
        color: #6b1f1f;
        font-size: 26px;
    }

    .timer {
        margin-top: 10px;
        display: inline-block;
        background: #6b1f1f;
        color: #fff;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: bold;
    }

    .question-block {
        margin-bottom: 25px;
        padding: 20px;
        border-radius: 8px;
        border-left: 6px solid #d4af37;
        background: #f9f9f9;
    }

    .question-block h3 {
        margin-top: 0;
        color: #6b1f1f;
        font-size: 18px;
    }

    .options {
        list-style: none;
        padding: 0;
        margin-top: 10px;
    }

    .options li {
        margin-bottom: 8px;
    }

    .options label {
        cursor: pointer;
        display: block;
        padding: 8px 10px;
        border-radius: 5px;
        background: #fff;
        border: 1px solid #ddd;
    }

    .options label:hover {
        background: #f1e6c8;
        border-color: #d4af37;
    }

    .submit-section {
        text-align: center;
        margin-top: 30px;
    }

    .submit-btn {
        background: #6b1f1f;
        color: #fff;
        padding: 14px 30px;
        font-size: 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    .submit-btn:hover {
        background: #8a2a2a;
    }

    #result {
        margin-top: 20px;
        font-size: 20px;
        font-weight: bold;
        color: #6b1f1f;
    }
</style>
</head>

<body>

<div class="quiz-container">

    <!-- Header -->
    <div class="quiz-header">
        <img src="gmulogo.jpg" alt="GM University Logo">
        <h1>GM University Physics Quiz</h1>
        <div class="timer">Time Left: <span id="time">20:00</span></div>
    </div>

    <!-- Questions -->
    <div id="question-container"></div>

    <!-- Submit -->
    <div class="submit-section">
        <button class="submit-btn" id="submitBtn" onclick="submitQuiz()">Submit Quiz</button>
        <div id="result"></div>
    </div>

</div>

<script>
    const TOTAL_QUESTIONS = 20;
    let selectedQuestions = [];
    let quizSubmitted = false;

    /* ================= TIMER ================= */
    let timeLeft = 1200; // seconds (20 minutes)
    const timerElement = document.getElementById("time");

    const timerInterval = setInterval(() => {
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            if (!quizSubmitted) {
                submitQuiz(true); // auto-submit
            }
            return;
        }

        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerElement.textContent =
            `${minutes}:${seconds.toString().padStart(2, "0")}`;

        timeLeft--;
    }, 1000);

    /* ============= QUESTION LOADING ============= */
    function shuffleArray(array) {
        const arr = [...array];
        for (let i = arr.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [arr[i], arr[j]] = [arr[j], arr[i]];
        }
        return arr;
    }

    fetch("questions.json")
        .then(res => res.json())
        .then(data => {
            selectedQuestions = shuffleArray(data.questions)
                .slice(0, TOTAL_QUESTIONS);

            const container = document.getElementById("question-container");
            container.innerHTML = "";

            selectedQuestions.forEach((q, index) => {
                container.innerHTML += `
                    <div class="question-block">
                        <h3>${index + 1}. ${q.question}</h3>
                        <ul class="options">
                            ${q.options.map(option => `
                                <li>
                                    <label>
                                        <input type="radio" name="q${index}" value="${option}">
                                        ${option}
                                    </label>
                                </li>
                            `).join("")}
                        </ul>
                    </div>
                `;
            });
        });

    /* ============= SUBMIT & SCORE ============= */
    function submitQuiz(auto = false) {
        if (quizSubmitted) return;
        quizSubmitted = true;

        clearInterval(timerInterval);
        document.getElementById("submitBtn").disabled = true;

        let score = 0;

        selectedQuestions.forEach((q, index) => {
            const selected = document.querySelector(
                `input[name="q${index}"]:checked`
            );
            if (selected && selected.value === q.correct_option) {
                score++;
            }
        });

        document.getElementById("result").innerText =
            auto
                ? `Time up! You scored ${score} out of ${TOTAL_QUESTIONS}`
                : `You scored ${score} out of ${TOTAL_QUESTIONS}`;
    }
</script>

</body>
</html>
