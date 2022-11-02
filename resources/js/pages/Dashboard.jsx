import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";

function Dashboard(props) {
    const [values,setValues] = useState([])

    useEffect(async()=>{
        setValues(JSON.parse(props.values));
    },[]);

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-10">
                    <table className="table table-striped">
                        <thead>
                            <tr>
                                {(()=>{ 
                                    if(values!=undefined && values.length!=0){
                                        return Object.keys(values[0]).map((key)=>{
                                            return (<th scope="col">{key}</th>)
                                        }
                                        )
                                    }
                                })()
                                }
                                    <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {values.map((value)=>{
                                return (
                                    <tr>
                                    {(()=>{ 
                                        if(values!=undefined && values.length!=0){
                                            return Object.keys(value).map((key)=>{
                                                return (<td>{value[key]}</td>)
                                            })
                                        }
                                    })()}
                                        <td className="d-flex">
                                            <a href={"/city/edit/"+value.id} className="btn btn-primary" >Edit</a>
                                            <a href={"/city/delete/"+value.id}className="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                ) 
                            })}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    )

}

export default Dashboard;

if (document.getElementById('dashboard')) 
{
    const element=document.getElementById('dashboard')
    const props=Object.assign({},element.dataset)
    ReactDOM.render(<Dashboard {...props}/>,
     document.getElementById('dashboard'));
}