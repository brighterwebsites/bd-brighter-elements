(function () {
  const quizzes = document.querySelectorAll('[data-bd-decision-quiz]');

  quizzes.forEach((quiz) => {
    const form = quiz.querySelector('[data-quiz-form]');
    const submitButton = quiz.querySelector('[data-quiz-submit]');
    const resetButton = quiz.querySelector('[data-quiz-reset]');
    const result = quiz.querySelector('[data-quiz-result]');
    const resultTitle = quiz.querySelector('[data-quiz-result-title]');
    const resultBody = quiz.querySelector('[data-quiz-result-body]');
    const error = quiz.querySelector('[data-quiz-error]');

    if (!form || !submitButton || !result || !resultTitle || !resultBody || !error) {
      return;
    }

    const setError = (message) => {
      if (message) {
        error.textContent = message;
        error.hidden = false;
      } else {
        error.textContent = '';
        error.hidden = true;
      }
    };

    const computeResult = () => {
      const selections = form.querySelectorAll('input[type="radio"]:checked');
      const totalFactors = form.querySelectorAll('[data-quiz-factor]').length;

      if (selections.length !== totalFactors) {
        setError('Please answer each factor to see your recommendation.');
        result.hidden = true;
        return;
      }

      setError('');
      const modularCount = Array.from(selections).filter((input) => input.dataset.choice === 'modular')
        .length;

      let title = '';
      let body = '';

      if (modularCount >= 4) {
        title = 'Recommendation: Modular build';
        body = 'You checked four or more modular boxes. The kit route will likely serve you best for speed, flexibility, and phased expansion.';
      } else if (modularCount >= 2) {
        title = 'Recommendation: Hybrid approach';
        body = 'Two or three modular signals suggests a hybrid solution — modular bays paired with a custom roof or arena.';
      } else {
        title = 'Recommendation: Custom build';
        body = 'One or fewer modular signals points to a custom build to suit site conditions and long-term requirements.';
      }

      resultTitle.textContent = title;
      resultBody.textContent = body;
      result.hidden = false;
    };

    submitButton.addEventListener('click', computeResult);

    if (resetButton) {
      resetButton.addEventListener('click', () => {
        form.reset();
        result.hidden = true;
        setError('');
      });
    }
  });
})();
