    package tn.gestion.promotion.enitite;

public class Reclamation {
    private int id;
    private String cin ;
    private String type;
    private String objet;
    private String message;
    private String date;

    public String getCin() {
        return cin;
    }

    public void setCin(String cin) {
        this.cin = cin;
    }
    
    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public String getObjet() {
        return objet;
    }

    public void setObjet(String objet) {
        this.objet = objet;
    }

    public String getMessage() {
        return message;
    }

    public void setMessage(String message) {
        this.message = message;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    
    
    public Reclamation() {
    }

    public Reclamation(int id, String cin, String type, String objet, String message, String date) {
        this.id = id;
        this.cin = cin;
        this.type = type;
        this.objet = objet;
        this.message = message;
        this.date = date;
    }

    public Reclamation(String cin, String type, String objet, String message, String date) {
        this.cin = cin;
        this.type = type;
        this.objet = objet;
        this.message = message;
        this.date = date;
    }
    
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }


    @Override
    public String toString() {
        return "Categorie{" + "id=" + id + ", name=" + type + ", type=" + cin + '}';
    }

}
