
const quizId = document.getElementById('quizId').value;
const questionId = document.getElementById('questionId').value;
const csrfToken = document.getElementById('csrf-token').value;

let selectedAnswerIds = [];

function selectAnswer(element, answerId) {
    if (isRadioType()) {
        // Xử lý cho loại radio
        selectedAnswerIds = [answerId];
        // Đánh dấu đáp án được chọn
        document.querySelectorAll('[data-answer-id]').forEach(el => {
            el.classList.remove('selected');
        });
        element.classList.add('selected');
        // Kích hoạt nút xác nhận
        document.getElementById('confirm-btn').disabled = false;
    } else {
        // Xử lý cho loại checkbox
        if (selectedAnswerIds.includes(answerId)) {
            selectedAnswerIds = selectedAnswerIds.filter(id => id !== answerId);
            element.classList.remove('selected');
        } else {
            selectedAnswerIds.push(answerId);
            element.classList.add('selected');
        }
        // Kích hoạt nút xác nhận nếu có ít nhất một đáp án được chọn
        document.getElementById('confirm-btn').disabled = selectedAnswerIds.length === 0;
    }
    console.log(selectedAnswerIds);
}

function confirmAnswer() {
    if (isRadioType()) {
        // Xử lý cho loại radio
        if (selectedAnswerIds.length === 1) {
            // Gửi câu trả lời
            sendAnswer(selectedAnswerIds[0]);
        } else {
            // Không có hoặc có nhiều hơn một câu trả lời được chọn
            alert("Vui lòng chọn một câu trả lời.");
        }
    } else {
        // Xử lý cho loại checkbox
        if (selectedAnswerIds.length > 0) {
            // Gửi câu trả lời
            sendAnswer(selectedAnswerIds);
        } else {
            // Không có câu trả lời nào được chọn
            alert("Vui lòng chọn ít nhất một câu trả lời.");
        }
    }
}

async function sendAnswer(answerIds) {
    try {
        const response = await fetch(`/submit-answer/${quizId}/${questionId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ answer: answerIds })
        });

        if (!response.ok) {
            throw new Error('Network response was not ok.');
        }

        const data = await response.json();
        console.log(data);

        if (data.isCorrect) {
            alert('Đáp án đúng!');
        } else {
            alert('Đáp án sai!');
        }

        // Sau khi gửi câu trả lời thành công, chuyển sang câu hỏi tiếp theo
        // Ví dụ: window.location.href = '/next-question';
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
    }
}

function isRadioType() {
    // Kiểm tra loại câu trả lời: radio hoặc checkbox
    return questionType === 'radio';
}

document.getElementById('confirm-btn').addEventListener('click', confirmAnswer);

