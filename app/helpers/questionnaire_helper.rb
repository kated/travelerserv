module QuestionnaireHelper
  def questionnaire_for(parent)
    questions = ::QUESTIONS[parent.class.name]
    form_for @questionnaire_record, :url => polymorphic_path([:participant, parent, :questionnaire_record]) do |form|
      content_tag :ul, :class => 'questions' do
        i = 0
        questions.collect do |question|
          raise "Question #{question.inspect} is missing 'type' attribute" if question["type"].blank?
          raise "Question #{question.inspect} is missing 'key' attribute" if question["key"].blank?
          data_attrs = {"data-key" => question["key"]}.merge(question["conditional_on"] ? {"data-conditional-key" => question["conditional_on"]["key"],
                                                                                           "data-conditional-answer" => question["conditional_on"]["answer"]} : {})
          content_tag(:li, {:class => question["type"] + (question["conditional_on"] ? " conditional" : "")}.merge(data_attrs)) do
            if question["type"] == "MultipleChoiceMultipleAnswer"
              other_answer = if question["allow_other"]
                answer = form.object.questionnaire_record_fields.find_or_initialize_by_question_key_and_other(question['key'], true)
                answer.kind = question["type"]
                answer.question = question["question"]
                answer.other = true
                form.fields_for(:questionnaire_record_fields_attributes, answer, :index => (i += 1)) do |fields|
                  fields.hidden_field(:id) +
                          render_question(parent, question, fields)
                end
              end


              content_tag :fieldset do
                content_tag(:legend, question["question"]) +
                        raw(
                                (question["answer_choices"].collect do |ans|
                                  answer = form.object.questionnaire_record_fields.find_or_initialize_by_question_key_and_text(question['key'], ans)
                                  answer.kind = question["type"]
                                  answer.question = question["question"]
                                  form.fields_for(:questionnaire_record_fields_attributes, answer, :index => (i += 1)) do |fields|
                                    fields.hidden_field(:id) +
                                            render_question(parent, question, fields)
                                  end
                                end + [other_answer]).join(""))
              end
            else
              answer = form.object.questionnaire_record_fields.find_or_initialize_by_question_key(question['key'])
              answer.kind = question["type"]
              answer.question = question["question"]
              answer.checked = true
              form.fields_for(:questionnaire_record_fields_attributes, answer, :index => (i += 1)) do |fields|
                fields.hidden_field(:id) +
                        render_question(parent, question, fields)
              end
            end
          end
        end.flatten.join("").html_safe +
                form.submit('Save')
      end
    end
  end

  def render_question(parent, question, form)
    render :partial => "/participant/questionnaire_records/questions/#{question["type"].underscore}", :locals =>
            {:question => question, :parent => parent, :form => form}
  rescue ActionView::MissingTemplate
    "<i>Unknown question type #{question["type"]}, ignoring.</i>".html_safe
  end
end
