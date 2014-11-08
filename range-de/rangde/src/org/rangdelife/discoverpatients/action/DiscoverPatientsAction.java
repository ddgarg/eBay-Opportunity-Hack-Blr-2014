/**
 * 
 */
package org.rangdelife.discoverpatients.action;

import org.rangdelife.discoverpatients.model.PatientDetailsModel;

import com.opensymphony.xwork2.ActionSupport;
import com.opensymphony.xwork2.ModelDriven;

/**
 * @author RangDe
 * 
 */
public class DiscoverPatientsAction extends ActionSupport implements
		ModelDriven<PatientDetailsModel> {

	private static final long serialVersionUID = 1L;

	@Override
	public PatientDetailsModel getModel() {
		return null;
	}

	public String testMethod(){
		// TODO Call the service layer method here
		return SUCCESS;
	}
	
}
