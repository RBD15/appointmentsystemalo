import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";

const Dashboard=(props)=> {
    const route=props.route
    const token=props.token
    const [values,setValues] = useState([])

    useEffect(async()=>{
        setValues(JSON.parse(props.values));
    },[]);

    const sendAction=(event,action,id)=>{
        event.preventDefault()
        let url=window.location.hostname
        if(url=='localhost'){
            url = window.location.protocol+'//'+window.location.hostname+':'+window.location.port+route
        }

        switch(action){
            case 'edit':
                break;
            case 'delete':
                const data={
                    mode:'cors',
                    method:'DELETE',
                    headers:{
                        Accept: 'application/json',
                        'Content-Type':'application/json',
                        'X-CSRF-TOKEN': token
                    }
                }
                fetch('http://localhost:8000'+route+'/'+id,data).then(
                    res=>window.location.href=url
                ).catch(err=>console.error(err))
                break;
            default:
                break
        }
    }

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-10">
                    <table className="table table-striped" >
                        <thead>
                            <tr key={route}>
                                {(()=>{ 
                                    if(values!=undefined && values.length!=0){
                                        return Object.keys(values[0]).map((key)=>{
                                            return (<th scope="col" key={'column'+key}>{key}</th>)
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
                                    <tr key={'id'+value.id}>
                                    {(()=>{ 
                                        if(values!=undefined && values.length!=0){
                                            return Object.keys(value).map((key)=>{
                                                return (<td key={'row'+key+value[key]} >{value[key]}</td>)
                                            })
                                        }
                                    })()}
                                        <td className="d-flex" key={value.id+'route'}>
                                            <a type="button"  href={route+'/'+value.id+'/edit'} className="btn btn-primary" key={value.id+''+route+'edit'}>Edit</a>
                                            <button type="button" className="btn btn-danger" key={value.id+''+route+'delete'}  onClick={(event)=>sendAction(event,'delete',value.id)} >Delete</button>
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