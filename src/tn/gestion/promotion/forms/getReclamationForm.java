package tn.gestion.promotion.forms;

import tn.gestion.promotion.forms.editFormReclamation;
import com.codename1.l10n.ParseException;
import com.codename1.ui.Button;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.TextField;
import com.codename1.ui.list.MultiList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.list.DefaultListModel;
import com.codename1.ui.util.Resources;
import java.util.Collections;
import java.util.Comparator;
import tn.gestion.promotion.enitite.Reclamation;
import tn.gestion.promotion.forms.BaseForm;
import tn.gestion.promotion.service.ReclamationWebService;

public class getReclamationForm extends BaseForm {

    private MultiList eventList;
    private List<Reclamation> reclamations;
    private TextField searchField;

    public getReclamationForm() {
        this.init(Resources.getGlobalResources());

        Button sortButton = new Button("Sort by Cin");
        sortButton.addActionListener(e -> {
            Collections.sort(reclamations, new Comparator<Reclamation>() {
                @Override
                public int compare(Reclamation c1, Reclamation c2) {
                    return c1.getType().compareToIgnoreCase(c2.getType());
                }
            });
            updateList();
        });
        addComponent(BorderLayout.south(sortButton));

        eventList = new MultiList(new DefaultListModel<>());
        add(eventList);
        getAllCats();

    }

    private void getAllCats() {
        ReclamationWebService service = new ReclamationWebService();
        reclamations = service.getAllReclamations();
        updateList();

        eventList.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent evt) {
                try {
                    Map<String, Object> selectedItem = (Map<String, Object>) eventList.getSelectedItem();
                    int catId = (int) selectedItem.get("Line3");
                    Reclamation selectedEvent = null;
                    for (Reclamation c : reclamations) {
                        if (c.getId() == catId) {
                            selectedEvent = c;
                            break;
                        }
                    }
                    editFormReclamation myForm2 = new editFormReclamation(selectedEvent);
                    myForm2.show();
                } catch (ParseException ex) {
                    System.out.println(ex);
                }
            }
        });

        searchField = new TextField("", "Enter Reclamation Cin");
        Button searchButton = new Button("Search");
        searchButton.addActionListener(e -> {
            try {
                String searchId = searchField.getText();
                Reclamation selectedPromo = null;
                for (Reclamation p : reclamations) {
                    if (p.getCin() == null ? searchId == null : p.getCin().equals(searchId)) {
                        selectedPromo = p;
                        break;
                    }
                }
                if (selectedPromo != null) {
                    editFormReclamation myForm2 = new editFormReclamation(selectedPromo);
                    myForm2.show();
                } else {
                    Dialog.show("Error", "Reclamation not found", "OK", null);
                }
            } catch (NumberFormatException ex) {
                Dialog.show("Error", "Invalid ID", "OK", null);
            } catch (ParseException ex) {
                System.out.println(ex);
            }
        });
        Container searchContainer = BorderLayout.west(searchField).add(BorderLayout.EAST, searchButton);
        addComponent(searchContainer);
    }

    private void updateList() {
        DefaultListModel<Map<String, Object>> model = (DefaultListModel<Map<String, Object>>) eventList.getModel();
        model.removeAll();
        for (Reclamation c : reclamations) {
            Map<String, Object> item = new HashMap<>();
            item.put("Line1", "Nom : " + c.getType());
            item.put("Line2", "Type : " + c.getCin());
            item.put("Line3", c.getId());
            model.addItem(item);
        }
    }
}
