package com.rangde.domain;

import java.util.Date;

public class Payments {

	
	private Integer id;
	private Integer caseId;
	private Investors investorId;
	private Integer donationAmount;
	private Enum paymentMode;
	private String transactionId;
	private Integer bankId;
	private String responseCode;
	private Enum payment_status;
	private Date transaction_date;
	private Date last_updated;
	private Enum isTransactionAnonymous;
	private Enum is_80G_sent;
	public Integer getId() {
		return id;
	}
	public void setId(Integer id) {
		this.id = id;
	}
	public Integer getCaseId() {
		return caseId;
	}
	public void setCaseId(Integer caseId) {
		this.caseId = caseId;
	}
	public Investors getInvestorId() {
		return investorId;
	}
	public void setInvestorId(Investors investorId) {
		this.investorId = investorId;
	}
	public Integer getDonationAmount() {
		return donationAmount;
	}
	public void setDonationAmount(Integer donationAmount) {
		this.donationAmount = donationAmount;
	}
	public Enum getPaymentMode() {
		return paymentMode;
	}
	public void setPaymentMode(Enum paymentMode) {
		this.paymentMode = paymentMode;
	}
	public String getTransactionId() {
		return transactionId;
	}
	public void setTransactionId(String transactionId) {
		this.transactionId = transactionId;
	}
	public Integer getBankId() {
		return bankId;
	}
	public void setBankId(Integer bankId) {
		this.bankId = bankId;
	}
	public String getResponseCode() {
		return responseCode;
	}
	public void setResponseCode(String responseCode) {
		this.responseCode = responseCode;
	}
	public Enum getPayment_status() {
		return payment_status;
	}
	public void setPayment_status(Enum payment_status) {
		this.payment_status = payment_status;
	}
	public Date getTransaction_date() {
		return transaction_date;
	}
	public void setTransaction_date(Date transaction_date) {
		this.transaction_date = transaction_date;
	}
	public Date getLast_updated() {
		return last_updated;
	}
	public void setLast_updated(Date last_updated) {
		this.last_updated = last_updated;
	}
	public Enum getIsTransactionAnonymous() {
		return isTransactionAnonymous;
	}
	public void setIsTransactionAnonymous(Enum isTransactionAnonymous) {
		this.isTransactionAnonymous = isTransactionAnonymous;
	}
	public Enum getIs_80G_sent() {
		return is_80G_sent;
	}
	public void setIs_80G_sent(Enum is_80g_sent) {
		is_80G_sent = is_80g_sent;
	}
	
}
