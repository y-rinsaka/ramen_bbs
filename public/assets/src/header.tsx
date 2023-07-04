import * as React from 'react';
import Toolbar from '@mui/material/Toolbar';
import IconButton from '@mui/material/IconButton';
import AddIcon from '@mui/icons-material/Add';
import AccountCircleIcon from '@mui/icons-material/AccountCircle';
import LogoutIcon from '@mui/icons-material/Logout';
import Typography from '@mui/material/Typography';
import Link from '@mui/material/Link';

interface HeaderProps {
  title: string;
  current_user_id: string;
}


export default function Header(props: HeaderProps) {
  const { title } = props;
  const { current_user_id } = props;

  return (
    <React.Fragment>
      <Toolbar sx={{ borderBottom: 2, borderColor: 'divider', backgroundColor: "#f5f5f5"}}>
        <Typography
          component="h1"
          variant="h5"
          align="left"
          noWrap
          sx={{ flex: 1 }}
        >
          <Link href="/" underline="none">{title}</Link>
        </Typography>
        
        <IconButton href="/post/create">
          <AddIcon color="primary"/>
        </IconButton>
        <IconButton href={`/user/index/${current_user_id}`}>
          <AccountCircleIcon color="primary"/>
        </IconButton>
        <IconButton href="/logout">
          <LogoutIcon color="primary"/>
        </IconButton>
      </Toolbar>
      <Toolbar
        component="nav"
        variant="dense"
        sx={{ justifyContent: 'space-between', overflowX: 'auto'}}
      >

        
      </Toolbar>
    </React.Fragment>
  );
}