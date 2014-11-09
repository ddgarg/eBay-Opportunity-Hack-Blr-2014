package com.rangde.domain;

import java.util.Date;

public class PatientCaseProfile
{
	
	private Integer id;
	private PatientPersonalProfile patientId;
	private Integer partnerHospitalId;
	private Integer doctorId;
	private String caseStudyVideoLink;
	private String caseFilesLocation;
	private Integer threatToLife;
	private Integer riskToLiveLiHood;
	private Date caseReferredOn;
	private Date estimatedFundRaisingDate;
	private Date estimatedAdmissionDate;
	private Date estimatedSurgeryDate;
	private Date estimatedDischargeDate;
	private Date profileSubmissionDate;
	private Integer vounteerId;
	private Integer totalAmountNeeded;
	private Integer totalAmountRaised;
	private Integer totalPledgedAmount;
	public Integer getId() {
		return id;
	}
	public void setId(Integer id) {
		this.id = id;
	}
	public PatientPersonalProfile getPatientId() {
		return patientId;
	}
	public void setPatientId(PatientPersonalProfile patientId) {
		this.patientId = patientId;
	}
	public Integer getPartnerHospitalId() {
		return partnerHospitalId;
	}
	public void setPartnerHospitalId(Integer partnerHospitalId) {
		this.partnerHospitalId = partnerHospitalId;
	}
	public Integer getDoctorId() {
		return doctorId;
	}
	public void setDoctorId(Integer doctorId) {
		this.doctorId = doctorId;
	}
	public String getCaseStudyVideoLink() {
		return caseStudyVideoLink;
	}
	public void setCaseStudyVideoLink(String caseStudyVideoLink) {
		this.caseStudyVideoLink = caseStudyVideoLink;
	}
	public String getCaseFilesLocation() {
		return caseFilesLocation;
	}
	public void setCaseFilesLocation(String caseFilesLocation) {
		this.caseFilesLocation = caseFilesLocation;
	}
	public Integer getThreatToLife() {
		return threatToLife;
	}
	public void setThreatToLife(Integer threatToLife) {
		this.threatToLife = threatToLife;
	}
	public Integer getRiskToLiveLiHood() {
		return riskToLiveLiHood;
	}
	public void setRiskToLiveLiHood(Integer riskToLiveLiHood) {
		this.riskToLiveLiHood = riskToLiveLiHood;
	}
	public Date getCaseReferredOn() {
		return caseReferredOn;
	}
	public void setCaseReferredOn(Date caseReferredOn) {
		this.caseReferredOn = caseReferredOn;
	}
	public Date getEstimatedFundRaisingDate() {
		return estimatedFundRaisingDate;
	}
	public void setEstimatedFundRaisingDate(Date estimatedFundRaisingDate) {
		this.estimatedFundRaisingDate = estimatedFundRaisingDate;
	}
	public Date getEstimatedAdmissionDate() {
		return estimatedAdmissionDate;
	}
	public void setEstimatedAdmissionDate(Date estimatedAdmissionDate) {
		this.estimatedAdmissionDate = estimatedAdmissionDate;
	}
	public Date getEstimatedSurgeryDate() {
		return estimatedSurgeryDate;
	}
	public void setEstimatedSurgeryDate(Date estimatedSurgeryDate) {
		this.estimatedSurgeryDate = estimatedSurgeryDate;
	}
	public Date getEstimatedDischargeDate() {
		return estimatedDischargeDate;
	}
	public void setEstimatedDischargeDate(Date estimatedDischargeDate) {
		this.estimatedDischargeDate = estimatedDischargeDate;
	}
	public Date getProfileSubmissionDate() {
		return profileSubmissionDate;
	}
	public void setProfileSubmissionDate(Date profileSubmissionDate) {
		this.profileSubmissionDate = profileSubmissionDate;
	}
	public Integer getVounteerId() {
		return vounteerId;
	}
	public void setVounteerId(Integer vounteerId) {
		this.vounteerId = vounteerId;
	}
	public Integer getTotalAmountNeeded() {
		return totalAmountNeeded;
	}
	public void setTotalAmountNeeded(Integer totalAmountNeeded) {
		this.totalAmountNeeded = totalAmountNeeded;
	}
	public Integer getTotalAmountRaised() {
		return totalAmountRaised;
	}
	public void setTotalAmountRaised(Integer totalAmountRaised) {
		this.totalAmountRaised = totalAmountRaised;
	}
	public Integer getTotalPledgedAmount() {
		return totalPledgedAmount;
	}
	public void setTotalPledgedAmount(Integer totalPledgedAmount) {
		this.totalPledgedAmount = totalPledgedAmount;
	}
}
