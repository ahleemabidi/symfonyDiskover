package tn.gestion.promotion.forms;

import com.codename1.l10n.ParseException;
import com.codename1.ui.Button;
import com.codename1.ui.PickerComponent;
import com.codename1.ui.TextField;
import com.codename1.ui.util.Resources;
import java.util.Date;
import tn.gestion.promotion.enitite.Reclamation;
import tn.gestion.promotion.forms.BaseForm;
import tn.gestion.promotion.forms.getReclamationForm;
import tn.gestion.promotion.service.ReclamationWebService;

public class editFormReclamation extends BaseForm {

    ReclamationWebService service = new ReclamationWebService();
    public editFormReclamation(Reclamation e) throws ParseException {
        this.init(Resources.getGlobalResources());
        
        TextField nomField = new TextField(e.getCin(), "cin");
        TextField typeField = new TextField(e.getType(), "type");
        TextField objetField = new TextField(e.getObjet(), "objet");
        TextField messageField = new TextField(e.getMessage(), "message");
        PickerComponent dateField = PickerComponent.createDate(new Date());
        
        this.add(nomField);
        this.add(typeField);
        this.add(objetField);
        this.add(messageField);
        this.add(dateField);
        
        Button submitButton = new Button("Submit");
        submitButton.addActionListener(s-> {
            String nom = nomField.getText();
            String type = typeField.getText();
            String objet = objetField.getText();
            String message= messageField.getText();
            String dateDebut = dateField.getPicker().getDate().toString();

            Reclamation newReclamation = new Reclamation();
            newReclamation.setId(e.getId());
            newReclamation.setCin(nom);
            newReclamation.setType(type);
            newReclamation.setObjet(objet);
            newReclamation.setMessage(message);
            newReclamation.setDate(dateDebut);
            
            service.editReclamation(newReclamation);
            getReclamationForm myForm = new getReclamationForm();
            myForm.show();
        }
        );
        Button goToFormButton = new Button("Go back");
        goToFormButton.addActionListener(ee -> {
            getReclamationForm myForm = new getReclamationForm();
            myForm.show();
        });
        Button deleteButton = new Button("Delete");
        deleteButton.addActionListener(cc -> {
            service.delReclamation(e);
            getReclamationForm myForm = new getReclamationForm();
            myForm.show();
        });
        this.add(deleteButton);
        this.add(goToFormButton);
        this.add(submitButton);
    }

}
