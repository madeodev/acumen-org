export default () => {
  return {
    getStatHTML(string) {
      const stat = string.split('');
      let html = '';

      stat.forEach((digit, statIndex) => {
        if (isNaN(digit)) {
          html += `<span class="h-full">${digit}</span>`;
        } else {
          for (let i = 0; i < digit.length; i++) {
            html += `<span 
                data-digit="${digit[i]}" 
                class="z-1 flex items-center flex-col h-full transform translate-y-0 transition-all duration-1000"
                style="transition-delay: ${statIndex * 5}0ms"
              >
                <span class="h-full">&ndash;</span>
                ${Array(parseInt(digit[i]) + 1)
                  .join(0)
                  .split(0)
                  .map((x, j) => `<span class="h-full">${j}</span>`)
                  .join('')}
              </span>`;
          }
        }
      });
      return html;
    },

    animateNumber(element) {
      element.style.width = element.clientWidth + 'px';
      element.dataset.isAnimated = true;
      const digits = element.childNodes;
      digits.forEach((digit) => {
        if (digit.style.transform == '' && digit.dataset.digit) {
          // Animate to the last element
          digit.style.transform = `translateY(-${
            (parseInt(digit.dataset.digit) + 1) * 100
          }%)`;
          // Set starting width
          digit.style.width = digit.clientWidth + 'px';
          // Set width to final showing element to maintain proper letter spacing
          setTimeout(() => {
            digit.style.width = digit.lastElementChild.clientWidth + 'px';
          }, 5);
        }
      });
    },

    // reset width of elements on window resize
    unsetWidth(element, timeout = 1001){
      element.style.width = '';
      if(!element.dataset.isAnimated) return;
      const digits = element.childNodes;
      digits.forEach((digit) => {
        if(digit.dataset.digit){   
          //  reset width of animated numerals to final numeral width after 1000ms transition finishes
          setTimeout(() => {
          digit.style.width = digit.lastElementChild.clientWidth + 'px';
        }, timeout);
        }
      });
    },
  };
};
