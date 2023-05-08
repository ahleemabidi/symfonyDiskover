package tn.gestion.promotion.forms;

import com.codename1.ui.*;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.util.Resources;

public class BaseForm extends com.codename1.ui.Form {

    public void init(Resources theme) {
        Toolbar tb = getToolbar();

        tb.getAllStyles().setBgColor(0xffffff);

        Image logo = theme.getImage("logo.png");
        Label logoLabel = new Label(logo);
        Container logoContainer = BorderLayout.center(logoLabel);
        logoContainer.setUIID("SideCommandLogo");
        tb.addComponentToSideMenu(logoContainer);

        Label taglineLabel = new Label("Gestion Reclamation");
        taglineLabel.setUIID("SideCommandTagline");
        Container taglineContainer = BorderLayout.south(taglineLabel);
        taglineContainer.setUIID("SideCommand");
        
        tb.addComponentToSideMenu(taglineContainer);
        
        tb.addMaterialCommandToSideMenu("Liste Reclamation", FontImage.MATERIAL_LIST, e -> {
            getReclamationForm f = new getReclamationForm();
            f.show();
        });
        tb.addMaterialCommandToSideMenu("Ajouter Reclamation", FontImage.MATERIAL_ADD, e -> {
            newReclamationeForm f = new newReclamationeForm();
            f.show();
        });
    }
}
