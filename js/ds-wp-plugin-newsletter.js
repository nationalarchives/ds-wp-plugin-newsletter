/**
 * TNA Newsletter
 * Enable/Disable Submit button when the user accepts TNA's Privacy Policy
 */
var dsWpPluginNewsletter = function() {
  var btn = document.querySelector('#newsletterSignUp');

  if(btn !== null && btn !== 'undefined') {

    var toggleButton = function(checkbox) {
      if (checkbox.checked) {
        btn.disabled = false;
        btn.classList.remove('disabled');
      } else {
        btn.disabled = true;
        btn.classList.add('disabled');
      }
    }

    var checkBox = document.querySelector('#privacy_policy');

    toggleButton(checkBox);

    checkBox.addEventListener('click', function(e) {
      toggleButton(e.target);
    });

  }

};

window.addEventListener('DOMContentLoaded', dsWpPluginNewsletter);
