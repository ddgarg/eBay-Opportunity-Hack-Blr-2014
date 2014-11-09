package com.rangde.domain;

public class DoctorProfile {

	private Integer id;
	private String name;
	private String qualification;
	private String associatedHospital;
	private Integer yearsOfExperience;
	private String photoId;
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
	public String getQualification() {
		return qualification;
	}
	public void setQualification(String qualification) {
		this.qualification = qualification;
	}
	public String getAssociatedHospital() {
		return associatedHospital;
	}
	public void setAssociatedHospital(String associatedHospital) {
		this.associatedHospital = associatedHospital;
	}
	public Integer getYearsOfExperience() {
		return yearsOfExperience;
	}
	public void setYearsOfExperience(Integer yearsOfExperience) {
		this.yearsOfExperience = yearsOfExperience;
	}
	public String getPhotoId() {
		return photoId;
	}
	public void setPhotoId(String photoId) {
		this.photoId = photoId;
	}
}
