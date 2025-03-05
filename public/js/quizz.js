let selectedAnswerIds = [];

function selectAnswer(element, answerId) {
    if (isRadioType()) {
        selectedAnswerIds = [answerId];
        document.querySelectorAll('[data-answer-id]').forEach(el => {
            el.classList.remove('selected');
        });
        element.classList.add('selected');
        document.getElementById('confirm-btn').disabled = false;
    } else {
        if (selectedAnswerIds.includes(answerId)) {
            selectedAnswerIds = selectedAnswerIds.filter(id => id !== answerId);
            element.classList.remove('selected');
        } else {
            selectedAnswerIds.push(answerId);
            element.classList.add('selected');
        }
        document.getElementById('confirm-btn').disabled = selectedAnswerIds.length === 0;
    }
    console.log(selectedAnswerIds);
}

function confirmAnswer() {
    var url = document.getElementById('confirm-btn').getAttribute('data-url');

    // Disable the button immediately to prevent multiple submissions
    document.getElementById('confirm-btn').disabled = true;

    if (isRadioType()) {
        sendAnswer(url, selectedAnswerIds[0]);
    } else {
        sendAnswer(url, selectedAnswerIds);
    }
}

function sendAnswer(url, answerIds) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                console.log(data);

                var correctAnswerIds = data.correctAnswerIds || [];
                var selectedAnswerIds = Array.isArray(answerIds) ? answerIds : [answerIds];

                // Display color for each answer
                document.querySelectorAll('[data-answer-id]').forEach(el => {
                    var answerId = el.getAttribute('data-answer-id');
                    el.classList.remove('selected', 'correct', 'incorrect');
                    if (selectedAnswerIds.includes(answerId)) {
                        el.classList.add('selected');
                        if (correctAnswerIds.includes(answerId)) {
                            el.classList.add('correct');
                        } else {
                            el.classList.add('incorrect');
                        }
                    }
                });

                // Mark the correct answers
                correctAnswerIds.forEach(correctAnswerId => {
                    var correctAnswerEl = document.querySelector(`[data-answer-id="${correctAnswerId}"]`);
                    if (correctAnswerEl) {
                        correctAnswerEl.classList.add('correct');
                    }
                });

                // Redirect to the next question after a delay
                setTimeout(function() {
                    window.location.href = data.nextQuestionUrl;
                }, 500); // Change to the next question after 0.5 seconds
            } else {
                console.error('Error:', xhr.statusText);
                document.getElementById('confirm-btn').disabled = false;
            }
        }
    };

    xhr.send(JSON.stringify({ answer: answerIds }));
}

function isRadioType() {
    return questionType === 'radio';
}
