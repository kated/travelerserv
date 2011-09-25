$(function() {
  $("#new_questionnaire_record, #edit_questionnaire_record").each(function() {
    $(this).find(":input").change(function() {
      updateConditionalStates();
    });
  });
  $.fx.off = true;
  updateConditionalStates();
  $.fx.off = false;
});

function log() {
  console.log && console.log(arguments);
}

function updateConditionalStates() {
  $("li.conditional").each(function() {
            var conditionalQuestion = $(this);
            var on_key = conditionalQuestion.data('conditional-key'),
                    on_answer = conditionalQuestion.data('conditional-answer'),
                    relevantQuestion = $("li[data-key='" + on_key + "']"),
                    havingCorrectVal = function() {
                      return $(this).val() == on_answer
                    },
                    selector = relevantQuestion.find($('input[type=hidden][name*=text]').filter(havingCorrectVal).nextAll(":checkbox:checked").add(//multipleanswer
                            $(', select > option:selected').filter(havingCorrectVal))); //multiplechoice
            log("checking selector", selector);
            if (selector.length > 0) {
              log(selector.length + " relevant inputs for ", on_key, on_answer);
              conditionalQuestion.fadeIn().find(":input").attr('enabled', true);
            } else {
              log("no relevant inputs for ", on_key, on_answer);
              conditionalQuestion.fadeOut().find(":input").attr('enabled', false);
            }

          }
  );
}
