module QuestionnaireHelper
  def new_questionnaire_for(parent)
    questions = ::QUESTIONS[parent.class.name]
    form_for @questionnaire_record, :url => polymorphic_path([:participant, parent, :questionnaire_record]) do |form|
      content_tag :ul, :class => 'questions' do
        questions.collect do |question|
          content_tag :li, :class => question["type"] do
            answer = form.object.questionnaire_record_fields.find_or_initialize_by_question_key(question['key'])
            answer.kind = question["type"]
            answer.question = question["question"]
            form.fields_for(answer) do |fields|
              render_question(parent, question, fields)
            end
          end
        end.join("").html_safe +
            form.submit('Save')
      end
    end
  end

  def render_question(parent, question, form)
    render :partial => "/participant/questionnaire_records/questions/#{question["type"].underscore}", :locals =>
        {:question => question, :parent => parent, :form => form}
  end
end