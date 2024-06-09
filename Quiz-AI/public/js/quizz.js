
const quizId = document.getElementById('quizId').value;
const questionId = document.getElementById('questionId').value;
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


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
    console.log(url);
    if (isRadioType()) {
        sendAnswer(url, selectedAnswerIds[0]);
    } else {
        sendAnswer(url, selectedAnswerIds);
    }
}

async function sendAnswer(url, answerIds) {
    // console.log(questionId, quizId, answerIds, url);
    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({  
            answer: answerIds 
        })

    });
    console.log(response);

    const data = await response.json();
}

function isRadioType() {
    return questionType === 'radio';
}

document.getElementById('confirm-btn').addEventListener('click', confirmAnswer);

