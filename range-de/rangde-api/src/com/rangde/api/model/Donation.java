package com.rangde.api.model;

public class Donation {
	
	private int patientId;
	private float amount;
	private String donorName;
	private String comment;
	//Needs to be changed.
	private String time;
	
	public Donation(){
		
	}
	
	public Donation(int patientId, float amount, String donorName, String comment, String time){
		this.patientId = patientId;
		this.amount = amount;
		this.donorName = donorName;
		this.comment = comment;
		this.time = time;
	}
	
	public int getPatientId() {
		return patientId;
	}
	public void setPatientId(int patientId) {
		this.patientId = patientId;
	}
	public float getAmount() {
		return amount;
	}
	public void setAmount(float amount) {
		this.amount = amount;
	}
	public String getDonorName() {
		return donorName;
	}
	public void setDonorName(String donorName) {
		this.donorName = donorName;
	}
	public String getComment() {
		return comment;
	}
	public void setComment(String comment) {
		this.comment = comment;
	}
	public String getTime() {
		return time;
	}
	public void setTime(String time) {
		this.time = time;
	}
	
}
