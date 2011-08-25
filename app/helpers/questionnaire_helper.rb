module QuestionnaireHelper
  def questionnaire_for(parent)
    questions = ::QUESTIONS[parent.class.name]
    form_for @questionnaire_record, :url => polymorphic_path([:participant, parent, :questionnaire_record]) do |form|
      content_tag :ul, :class => 'questions' do
        i = 0
        questions.collect do |question|
          i += 1
          content_tag :li, :class => question["type"] do
            answer = form.object.questionnaire_record_fields.find_or_initialize_by_question_key(question['key'])
            answer.kind = question["type"]
            answer.question = question["question"]
            form.fields_for(:questionnaire_record_fields_attributes, answer, :index => i) do |fields|
              fields.hidden_field(:id) +
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
