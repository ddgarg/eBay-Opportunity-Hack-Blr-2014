package com.rangde.domain;

import java.sql.Date;

public class PatientPersonalProfile {

	private Integer id;
	private String name;
	private String photoIds;
	private String dateOfBirths;
	public enum Gender {
	    MALE,FEMALE,TG
	}
	private String homeLocation;
	private String motherTongue;
	private String currentLocation;
	private String typeOfSurgery;
	private Integer annualFamilyIncome;	
	private String patientProfileHistory;
	private Date lastUpdatedDate;
	public Integer getId() {
		return id;
	}
	public void setId(Integer id) {
		this.id = id;
	}
	public String getName() {
		return name;
	}
	public void setName(String name) {
		this.name = name;
	}
	public String getPhotoIds() {
		return photoIds;
	}
	public void setPhotoIds(String photoIds) {
		this.photoIds = photoIds;
	}
	public String getDateOfBirths() {
		return dateOfBirths;
	}
	public void setDateOfBirths(String dateOfBirths) {
		this.dateOfBirths = dateOfBirths;
	}
	public String getHomeLocation() {
		return homeLocation;
	}
	public void setHomeLocation(String homeLocation) {
		this.homeLocation = homeLocation;
	}
	public String getMotherTongue() {
		return motherTongue;
	}
	public void setMotherTongue(String motherTongue) {
		this.motherTongue = motherTongue;
	}
	public String getCurrentLocation() {
		return currentLocation;
	}
	public void setCurrentLocation(String currentLocation) {
		this.currentLocation = currentLocation;
	}
	public String getTypeOfSurgery() {
		return typeOfSurgery;
	}
	public void setTypeOfSurgery(String typeOfSurgery) {
		this.typeOfSurgery = typeOfSurgery;
	}
	public Integer getAnnualFamilyIncome() {
		return annualFamilyIncome;
	}
	public void setAnnualFamilyIncome(Integer annualFamilyIncome) {
		this.annualFamilyIncome = annualFamilyIncome;
	}
	public String getPatientProfileHistory() {
		return patientProfileHistory;
	}
	public void setPatientProfileHistory(String patientProfileHistory) {
		this.patientProfileHistory = patientProfileHistory;
	}
	public Date getLastUpdatedDate() {
		return lastUpdatedDate;
	}
	public void setLastUpdatedDate(Date lastUpdatedDate) {
		this.lastUpdatedDate = lastUpdatedDate;
	}
}
