package tn.gestion.promotion.service;

import com.codename1.io.ConnectionRequest;
import com.codename1.io.NetworkManager;
import java.util.ArrayList;
import java.util.List;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import tn.gestion.promotion.enitite.Reclamation;

public class ReclamationWebService {

    private static final String BASE_URL = "http://127.0.0.1:8000/api";
    private ConnectionRequest connection;

    public ReclamationWebService() {
        connection = new ConnectionRequest();
        connection.setInsecure(true);
    }

    public List<Reclamation> getAllReclamations() {
        String url = BASE_URL + "/get";
        this.connection.setUrl(url);
        this.connection.setHttpMethod("GET");
        List<Reclamation> reclamations = new ArrayList<>();
        this.connection.addResponseListener(e -> {
            if (this.connection.getResponseCode() == 200) {
                String response = new String(this.connection.getResponseData());
                try {
                    JSONArray jsonEvents = new JSONArray(response);
                    for (int i = 0; i < jsonEvents.length(); i++) {
                        JSONObject jsonEvent = jsonEvents.getJSONObject(i);
                        Reclamation rec = new Reclamation(
                                jsonEvent.getInt("id"),
                                jsonEvent.getString("cin"),
                                jsonEvent.getString("type"),
                                jsonEvent.getString("objet"),
                                jsonEvent.getString("message"),
                                jsonEvent.getString("date")
                        );
                        reclamations.add(rec);
                    }
                } catch (JSONException ex) {
                    ex.printStackTrace();
                }
            } else {
            }
        });

        NetworkManager.getInstance().addToQueueAndWait(this.connection);
        return reclamations;
    }

    public void newReclamation(Reclamation c) {
        
        connection = new ConnectionRequest();
        connection.setInsecure(true);
        this.connection.setUrl(BASE_URL + "/add");
        this.connection.setHttpMethod("POST");

        connection.addArgument("cin", c.getCin());
        connection.addArgument("type", c.getType());
        connection.addArgument("objet", c.getObjet());
        connection.addArgument("message", c.getMessage());
        connection.addArgument("date", c.getDate());

        NetworkManager.getInstance().addToQueue(connection);
    }

    public void editReclamation(Reclamation c) {
        connection = new ConnectionRequest();
        connection.setInsecure(true);
        this.connection.setUrl(BASE_URL + "/edit/" + c.getId());
        this.connection.setHttpMethod("PUT");
        
        connection.addArgument("cin", c.getCin());
        connection.addArgument("type", c.getType());
        connection.addArgument("objet", c.getObjet());
        connection.addArgument("message", c.getMessage());
        connection.addArgument("date", c.getDate());
        
        NetworkManager.getInstance().addToQueue(connection);
    }

    public void delReclamation(Reclamation c) {
        connection = new ConnectionRequest();
        connection.setInsecure(true);
        this.connection.setUrl(BASE_URL + "/delete/" + c.getId());
        this.connection.setHttpMethod("DELETE");
        NetworkManager.getInstance().addToQueue(connection);
    }

}
