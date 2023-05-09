package tn.gestion.promotion.forms;

import tn.gestion.promotion.forms.getReclamationForm;
import com.codename1.ui.Button;
import com.codename1.ui.Dialog;
import com.codename1.ui.PickerComponent;
import com.codename1.ui.TextField;
import com.codename1.ui.util.Resources;
import java.util.Date;
import tn.gestion.promotion.enitite.Reclamation;
import tn.gestion.promotion.forms.BaseForm;
import tn.gestion.promotion.service.ReclamationWebService;

public class newReclamationeForm extends BaseForm {

    private static final String[] BAD_WORDS = {"débile ", "bête ", "idiot", "stupide", "insulte", "Enculé", "merde"}; // liste de mots inappropriés    

    public newReclamationeForm() {
        this.init(Resources.getGlobalResources());
        TextField nomField = new TextField("", "cin");
        TextField typeField = new TextField("", "type");
        TextField objetField = new TextField("", "objet");
        TextField messageField = new TextField("", "message");
        PickerComponent dateField = PickerComponent.createDate(new Date());

        this.add(nomField);
        this.add(typeField);
        this.add(objetField);
        this.add(messageField);
        this.add(dateField);

        Button submitButton = new Button("add");

        submitButton.addActionListener(s -> {
            String nom = nomField.getText();
            String type = typeField.getText();
            String objet = objetField.getText();
            String message = messageField.getText();
            String dateDebut = dateField.getPicker().getDate().toString();

            if (containsBadWords(message)) { // Vérifier si le message contient des mots inappropriés
                Dialog.show("Attention", "Votre message contient des mots inappropriés.", "OK", null);
                messageField.setText(""); // Effacer le champ de message
            } else {
                Reclamation newReclamation = new Reclamation();
                newReclamation.setCin(nom);
                newReclamation.setType(type);
                newReclamation.setObjet(objet);
                newReclamation.setMessage(message);
                newReclamation.setDate(dateDebut);

                ReclamationWebService service = new ReclamationWebService();
                service.newReclamation(newReclamation);
            }
        });

        this.add(submitButton);
        Button goToFormButton = new Button("Go Back");
        goToFormButton.addActionListener(e -> {
            getReclamationForm myForm = new getReclamationForm();
            myForm.show();
        });
        this.add(goToFormButton);
    }

    private boolean containsBadWords(String message) {
        for (String word : BAD_WORDS) {
            if (message.contains(word)) {
                return true;
            }
        }
        return false;
    }
}
