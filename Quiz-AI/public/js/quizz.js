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
    
    // Vô hiệu hóa nút ngay lập tức để ngăn chặn các lần nhấn tiếp theo
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

                // Hiển thị thông báo
                alert(data.message);

                // Chuyển sang câu hỏi tiếp theo sau khi thông báo
                window.location.href = data.nextQuestionUrl;
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
