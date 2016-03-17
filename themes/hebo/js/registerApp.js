/**
* registerRelatives Module
*
* Description
*/
angular.module('registerRelatives', [])
.controller('RegisterCtrl', ['$scope', function ($scope) {
	currentController = this;
	$scope.relatives = window.initialrelatives;
	this.canAddNewPerson = function(){
		verdict = false;
		/*checks last item from collection if it has valid values*/
		if ($scope.relatives.length !==0) {
			lastItem = $scope.relatives.pop();
			if ( lastItem.relativeRelationship.length  ) {
				verdict = true;
			}
		}
		$scope.relatives.push(lastItem);
		return verdict;
	}
	this.addRelative = function(){

		if (  $scope.relatives.length === 0 || currentController.canAddNewPerson()  ) {
			$scope.relatives.push({
				relativeFirstName:"",
				relativeMiddleName:"",
				relativeLastname:"",
				relativeRelationship:"",
			});
		}
	}
	this.removeRelative = function(key){
		$scope.relatives.splice(key,1);
	}

	
}])